<?php
session_start();
include('assets/inc/config.php');
include('assets/inc/checklogin.php');
check_login();

$pat_id = $_SESSION['pat_id'];

// Get the pidx from the URL
$pidx = $_GET['pidx'] ?? null;

if ($pidx) {
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://a.khalti.com/api/v2/epayment/lookup/',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode(['pidx' => $pidx]),
        CURLOPT_HTTPHEADER => array(
            'Authorization: key live_secret_key_68791341fdd94846a146f0457ff7b455',
            'Content-Type: application/json',
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);

    if ($response) {
        $responseArray = json_decode($response, true);
        switch ($responseArray['status']) {
            case 'Completed':
                // Update the bill status to PAID in the database
                $bill_pat_number = $_SESSION['pat_number'];
                $update = "UPDATE his_bills SET bill_status = 'PAID' WHERE bill_pat_number = ?";
                $stmt = $mysqli->prepare($update);
                if ($stmt) {
                    $stmt->bind_param('s', $bill_pat_number);
                    $stmt->execute();
                    $stmt->close();

                    $_SESSION['transaction_msg'] = '<script>
                        Swal.fire({
                            icon: "success",
                            title: "Transaction successful.",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    </script>';

                    $ret = "SELECT * FROM his_bills WHERE bill_pat_number = ?";
                    $stmt = $mysqli->prepare($ret);
                    if ($stmt) {
                        $stmt->bind_param('s', $bill_pat_number);
                        $stmt->execute();
                        $res = $stmt->get_result();
                        if ($row = $res->fetch_object()) {
                            header("Location: his_pat_view_single_bill.php?bill_number=" . $row->bill_number);
                            exit();
                        } else {
                            $_SESSION['transaction_msg'] = '<script>
                                Swal.fire({
                                    icon: "error",
                                    title: "Bill not found.",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            </script>';
                            header("Location: his_pat_payment.php");
                            exit();
                        }
                    } else {
                        $_SESSION['transaction_msg'] = '<script>
                            Swal.fire({
                                icon: "error",
                                title: "Database error.",
                                showConfirmButton: false,
                                timer: 1500
                            });
                        </script>';
                        header("Location: his_pat_payment.php");
                        exit();
                    }
                } else {
                    $_SESSION['transaction_msg'] = '<script>
                        Swal.fire({
                            icon: "error",
                            title: "Database update failed.",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    </script>';
                    header("Location: his_pat_payment.php");
                    exit();
                }
                break;
            case 'Expired':
            case 'User canceled':
            default:
                $_SESSION['transaction_msg'] = '<script>
                    Swal.fire({
                        icon: "error",
                        title: "Transaction failed.",
                        showConfirmButton: false,
                        timer: 1500
                    });
                </script>';
                header("Location: his_pat_payment.php");
                exit();
                break;
        }
    } else {
        $_SESSION['transaction_msg'] = '<script>
            Swal.fire({
                icon: "error",
                title: "No response from payment gateway.",
                showConfirmButton: false,
                timer: 1500
            });
        </script>';
        header("Location: his_pat_payment.php");
        exit();
    }
}
?>
