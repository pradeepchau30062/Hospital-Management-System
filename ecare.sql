-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2024 at 01:55 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecare`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointment_id` int(11) NOT NULL,
  `doc_fname` varchar(255) DEFAULT NULL,
  `doc_lname` varchar(255) DEFAULT NULL,
  `pat_fname` varchar(255) DEFAULT NULL,
  `pat_lname` varchar(255) DEFAULT NULL,
  `doc_number` varchar(255) DEFAULT NULL,
  `pat_number` int(11) DEFAULT NULL,
  `appointment_date` date DEFAULT NULL,
  `appointment_time` time DEFAULT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `his_accounts`
--

CREATE TABLE `his_accounts` (
  `acc_id` int(200) NOT NULL,
  `acc_name` varchar(200) DEFAULT NULL,
  `acc_desc` text DEFAULT NULL,
  `acc_type` varchar(200) DEFAULT NULL,
  `acc_number` varchar(200) DEFAULT NULL,
  `acc_amount` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `his_accounts`
--

INSERT INTO `his_accounts` (`acc_id`, `acc_name`, `acc_desc`, `acc_type`, `acc_number`, `acc_amount`) VALUES
(1, 'Individual Retirement Account', '<p>IRA&rsquo;s are simply an account where you stash your money for retirement. The concept is pretty simple, your account balance is not taxed UNTIL you withdraw, at which point you pay the taxes there. This allows you to grow your account with interest without taxes taking away from the balance. The net result is you earn more money.</p>', 'Payable Account', '518703294', '25000'),
(2, 'Equity Bank', '<p>Find <em>bank account</em> stock <em>images</em> in HD and millions of other royalty-free stock photos, illustrations and vectors in the Shutterstock collection. Thousands of new</p>', 'Receivable Account', '753680912', '12566'),
(3, 'Test Account Name', '<p>This is a demo test</p>', 'Payable Account', '620157843', '1100');

-- --------------------------------------------------------

--
-- Table structure for table `his_admin`
--

CREATE TABLE `his_admin` (
  `ad_id` int(20) NOT NULL,
  `ad_fname` varchar(200) DEFAULT NULL,
  `ad_lname` varchar(200) DEFAULT NULL,
  `ad_email` varchar(200) DEFAULT NULL,
  `ad_pwd` varchar(200) DEFAULT NULL,
  `ad_dpic` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `his_admin`
--

INSERT INTO `his_admin` (`ad_id`, `ad_fname`, `ad_lname`, `ad_email`, `ad_pwd`, `ad_dpic`) VALUES
(1, 'Admin', 'Hospital', 'teamsecret30062@gmail.com', 'fe9956c402ac9b58256264348ecaf5ce825f445e', 'doc-icon.png');

-- --------------------------------------------------------

--
-- Table structure for table `his_assets`
--

CREATE TABLE `his_assets` (
  `asst_id` int(20) NOT NULL,
  `asst_name` varchar(200) DEFAULT NULL,
  `asst_desc` longtext DEFAULT NULL,
  `asst_vendor` varchar(200) DEFAULT NULL,
  `asst_status` varchar(200) DEFAULT NULL,
  `asst_dept` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `his_bills`
--

CREATE TABLE `his_bills` (
  `bill_id` int(20) NOT NULL,
  `bill_number` varchar(255) DEFAULT NULL,
  `bill_pat_name` varchar(255) DEFAULT NULL,
  `bill_pat_number` varchar(255) DEFAULT NULL,
  `bill_pat_email` varchar(255) DEFAULT NULL,
  `bill_pat_fee` varchar(255) DEFAULT NULL,
  `bill_tax` varchar(255) DEFAULT NULL,
  `bill_date_generated` timestamp(4) NOT NULL DEFAULT current_timestamp(4) ON UPDATE current_timestamp(4),
  `bill_status` varchar(255) DEFAULT NULL,
  `bill_descr` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `his_bills`
--

INSERT INTO `his_bills` (`bill_id`, `bill_number`, `bill_pat_name`, `bill_pat_number`, `bill_pat_email`, `bill_pat_fee`, `bill_tax`, `bill_date_generated`, `bill_status`, `bill_descr`) VALUES
(8, '6T0E1', 'Nirajan Chaudhary', '20451', 'chaudharynirajan026@gmail.com', '2000', '2260', '2024-06-24 19:12:15.0025', 'PAID', '<p>hi</p>'),
(14, 'CYDWN', 'Binod  Chaudhary', '46715', 'bikkychaudhary5555@gmail.com', '500', '565', '2024-07-24 09:00:03.1512', 'UNPAID', '<p>checking</p>'),
(31, 'MSPZJ', 'Kanchan Chaudhary', '29978', 'kanchanchaudhary30062@gmail.com', '2000', '2260', '2024-07-25 10:41:30.9666', 'UNPAID', '<p>give</p>');

-- --------------------------------------------------------

--
-- Table structure for table `his_docs`
--

CREATE TABLE `his_docs` (
  `doc_id` int(20) NOT NULL,
  `doc_fname` varchar(200) DEFAULT NULL,
  `doc_lname` varchar(200) DEFAULT NULL,
  `doc_email` varchar(200) DEFAULT NULL,
  `doc_pwd` varchar(200) DEFAULT NULL,
  `doc_dept` varchar(200) DEFAULT NULL,
  `doc_number` varchar(200) DEFAULT NULL,
  `doc_dpic` varchar(200) DEFAULT NULL,
  `otp` varchar(6) DEFAULT NULL,
  `otp_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `his_docs`
--

INSERT INTO `his_docs` (`doc_id`, `doc_fname`, `doc_lname`, `doc_email`, `doc_pwd`, `doc_dept`, `doc_number`, `doc_dpic`, `otp`, `otp_expiry`) VALUES
(24, 'Dipesh', 'Tharu ', 'dipeshchaudhary918@gmail.com', 'fe9956c402ac9b58256264348ecaf5ce825f445e', 'OPD', 'QHTI', 'doc2.jpg', NULL, NULL),
(26, 'Binay ', 'Chaudhary', 'Binaychaudhary@gmail.com', 'fe9956c402ac9b58256264348ecaf5ce825f445e', 'X-ray', 'DVGZ', 'doc3.jpg', NULL, NULL),
(27, 'Rabina', 'Khatiwada', 'ribikhatiwada02@gmail.com', 'fe9956c402ac9b58256264348ecaf5ce825f445e', 'Emergency', 'HWAH', 'doc_girl.jpg', NULL, NULL),
(28, 'Mamita ', 'Chaudhary', 'mamitachaudhary9876@gmail.com', 'fe9956c402ac9b58256264348ecaf5ce825f445e', 'Laboratory', 'ATKO', 'doc_girl1.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `his_equipments`
--

CREATE TABLE `his_equipments` (
  `eqp_id` int(20) NOT NULL,
  `eqp_code` varchar(200) DEFAULT NULL,
  `eqp_name` varchar(200) DEFAULT NULL,
  `eqp_vendor` varchar(200) DEFAULT NULL,
  `eqp_desc` longtext DEFAULT NULL,
  `eqp_dept` varchar(200) DEFAULT NULL,
  `eqp_status` varchar(200) DEFAULT NULL,
  `eqp_qty` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `his_equipments`
--

INSERT INTO `his_equipments` (`eqp_id`, `eqp_code`, `eqp_name`, `eqp_vendor`, `eqp_desc`, `eqp_dept`, `eqp_status`, `eqp_qty`) VALUES
(2, '178640239', 'TestTubes', 'Casio', '<p>Testtubes are used to perform lab tests--</p>', 'Laboratory', 'Functioning', '700000'),
(4, '317958042', 'sessior', 'assass', '<p>fljddljerlksfielsrjzdcioo[rszjdc</p>', 'Surgical | Theatre', 'Functioning', '11');

-- --------------------------------------------------------

--
-- Table structure for table `his_laboratory`
--

CREATE TABLE `his_laboratory` (
  `lab_id` int(20) NOT NULL,
  `lab_pat_name` varchar(200) DEFAULT NULL,
  `lab_pat_ailment` varchar(200) DEFAULT NULL,
  `lab_pat_number` varchar(200) DEFAULT NULL,
  `lab_pat_tests` longtext DEFAULT NULL,
  `lab_pat_results` longtext DEFAULT NULL,
  `lab_number` varchar(200) DEFAULT NULL,
  `lab_date_rec` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `his_laboratory`
--

INSERT INTO `his_laboratory` (`lab_id`, `lab_pat_name`, `lab_pat_ailment`, `lab_pat_number`, `lab_pat_tests`, `lab_pat_results`, `lab_number`, `lab_date_rec`) VALUES
(13, 'Kanchan Chaudhary', 'Gastric Problem', '29978', '<ul><li>Complete Blood Count (CBC)</li><li>Basic Metabolic Panel (BMP)</li><li>Liver Function Tests (LFTs)</li><li>Amylase and Lipase</li><li>Stool Tests</li><li>Helicobacter pylori Test</li><li>Endoscopy</li><li>Colonoscopy</li><li>Abdominal Ultrasound</li><li>CT Scan (Computed Tomography)</li><li>MRI (Magnetic Resonance Imaging)</li><li>Barium Swallow/Meal</li><li>Breath Tests</li></ul>', '<ul><li><p><strong>Complete Blood Count (CBC)</strong></p><ul><li><strong>Hemoglobin</strong>: 13.5-17.5 g/dL (men), 12.0-15.5 g/dL (women)</li><li><strong>White Blood Cell Count</strong>: 4,000-11,000 cells/&micro;L</li><li><strong>Platelets</strong>: 150,000-450,000 cells/&micro;L</li></ul></li><li><p><strong>Basic Metabolic Panel (BMP)</strong></p><ul><li><strong>Sodium</strong>: 135-145 mmol/L</li><li><strong>Potassium</strong>: 3.5-5.0 mmol/L</li><li><strong>Chloride</strong>: 98-106 mmol/L</li><li><strong>Bicarbonate</strong>: 22-29 mmol/L</li><li><strong>Glucose</strong>: 70-100 mg/dL (fasting)</li><li><strong>Calcium</strong>: 8.5-10.2 mg/dL</li><li><strong>Creatinine</strong>: 0.6-1.2 mg/dL</li></ul></li><li><p><strong>Liver Function Tests (LFTs)</strong></p><ul><li><strong>Alanine Aminotransferase (ALT)</strong>: 7-56 U/L</li><li><strong>Aspartate Aminotransferase (AST)</strong>: 10-40 U/L</li><li><strong>Alkaline Phosphatase (ALP)</strong>: 44-121 U/L</li><li><strong>Bilirubin</strong>: 0.1-1.2 mg/dL</li></ul></li><li><p><strong>Amylase and Lipase</strong></p><ul><li><strong>Amylase</strong>: 30-110 U/L</li><li><strong>Lipase</strong>: 0-160 U/L</li></ul></li><li><p><strong>Stool Tests</strong></p><ul><li><strong>Occult Blood Test</strong>: Negative</li><li><strong>Stool Culture</strong>: No pathogenic bacteria isolated</li><li><strong>Stool Ova and Parasites</strong>: No parasites detected</li></ul></li><li><p><strong>Helicobacter pylori Test</strong></p><ul><li><strong>Blood Test</strong>: Negative (no antibodies detected)</li><li><strong>Breath Test</strong>: Negative (no carbon dioxide detected)</li><li><strong>Stool Antigen Test</strong>: Negative (no antigens detected)</li></ul></li><li><p><strong>Endoscopy</strong></p><ul><li><strong>Findings</strong>: Normal mucosa, no erosions, ulcers, or abnormalities</li></ul></li><li><p><strong>Colonoscopy</strong></p><ul><li><strong>Findings</strong>: Normal colon lining, no polyps, no signs of inflammation</li></ul></li><li><p><strong>Abdominal Ultrasound</strong></p><ul><li><strong>Findings</strong>: Normal liver, gallbladder, pancreas, and kidneys; no abnormalities detected</li></ul></li><li><p><strong>CT Scan (Computed Tomography)</strong></p><ul><li><strong>Findings</strong>: No masses, normal organ structure, no evidence of abnormal fluid or enlargement</li></ul></li><li><p><strong>MRI (Magnetic Resonance Imaging)</strong></p><ul><li><strong>Findings</strong>: Normal abdominal organs, no tumors or structural abnormalities</li></ul></li><li><p><strong>Barium Swallow/Meal</strong></p><ul><li><strong>Findings</strong>: Normal swallowing function, no structural abnormalities in the esophagus or stomach</li></ul></li><li><p><strong>Breath Tests</strong></p><ul><li><strong>Hydrogen Breath Test</strong>: Negative for lactose intolerance or SIBO</li></ul></li></ul>', 'L1TEG', '2024-07-25 11:41:51');

-- --------------------------------------------------------

--
-- Table structure for table `his_medical_records`
--

CREATE TABLE `his_medical_records` (
  `mdr_id` int(20) NOT NULL,
  `mdr_number` varchar(200) DEFAULT NULL,
  `mdr_pat_name` varchar(200) DEFAULT NULL,
  `mdr_pat_adr` varchar(200) DEFAULT NULL,
  `mdr_pat_age` varchar(200) DEFAULT NULL,
  `mdr_pat_ailment` varchar(200) DEFAULT NULL,
  `mdr_pat_number` varchar(200) DEFAULT NULL,
  `mdr_pat_prescr` longtext DEFAULT NULL,
  `mdr_date_rec` timestamp(4) NOT NULL DEFAULT current_timestamp(4) ON UPDATE current_timestamp(4)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `his_medical_records`
--

INSERT INTO `his_medical_records` (`mdr_id`, `mdr_number`, `mdr_pat_name`, `mdr_pat_adr`, `mdr_pat_age`, `mdr_pat_ailment`, `mdr_pat_number`, `mdr_pat_prescr`, `mdr_date_rec`) VALUES
(1, 'ZNXI4', 'John Doe', '12 900 Los Angeles', '35', 'Malaria', 'RAV6C', '<ul><li>Combination of atovaquone and proguanil (Malarone)</li><li>Quinine sulfate (Qualaquin) with doxycycline (Vibramycin, Monodox, others)</li><li>Mefloquine.</li><li>Primaquine phosphate.</li></ul>', '2020-01-11 15:03:05.9839'),
(2, 'MIA9P', 'Cynthia Connolly', '9 Hill Haven Drive', '22', 'Demo Test', '3Z14K', NULL, '2022-10-18 17:07:46.7306'),
(3, 'F1ZHQ', 'Michael White', '60 Radford Street', '30', 'Demo Test', 'DCRI8', NULL, '2022-10-18 17:08:35.7938'),
(4, 'ZLN0Q', 'Lawrence Bischof', '82 Bryan Street', '32', 'Demo Test', 'ISL1E', '<ol><li>sample</li><li>sampl</li><li>sample</li><li>sample</li></ol>', '2022-10-20 17:22:15.7034');

-- --------------------------------------------------------

--
-- Table structure for table `his_patients`
--

CREATE TABLE `his_patients` (
  `pat_id` int(20) NOT NULL,
  `pat_fname` varchar(200) DEFAULT NULL,
  `pat_lname` varchar(200) DEFAULT NULL,
  `pat_pwd` varchar(255) DEFAULT NULL,
  `pat_email` varchar(255) DEFAULT NULL,
  `pat_dpic` varchar(255) DEFAULT NULL,
  `pat_dob` varchar(200) DEFAULT NULL,
  `pat_age` varchar(200) DEFAULT NULL,
  `pat_number` varchar(200) DEFAULT NULL,
  `pat_addr` varchar(200) DEFAULT NULL,
  `pat_phone` varchar(200) DEFAULT NULL,
  `pat_type` varchar(200) DEFAULT NULL,
  `pat_date_joined` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `pat_ailment` varchar(200) DEFAULT NULL,
  `pat_discharge_status` varchar(200) DEFAULT NULL,
  `surgery_status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `his_patients`
--

INSERT INTO `his_patients` (`pat_id`, `pat_fname`, `pat_lname`, `pat_pwd`, `pat_email`, `pat_dpic`, `pat_dob`, `pat_age`, `pat_number`, `pat_addr`, `pat_phone`, `pat_type`, `pat_date_joined`, `pat_ailment`, `pat_discharge_status`, `surgery_status`) VALUES
(28, 'Kanchan', 'Chaudhary', 'fe9956c402ac9b58256264348ecaf5ce825f445e', 'kanchanchaudhary30062@gmail.com', 'woman1.jpeg', '2024-06-05', '27', '29978', 'Nijgadh', '9845860156', 'OutPatient', '2024-06-22 16:54:00.092845', 'Gastric Problem', NULL, NULL),
(29, 'Nirajan', 'Chaudhary', 'fe9956c402ac9b58256264348ecaf5ce825f445e', 'chaudharynirajan026@gmail.com', 'man2.jpg', '2024-06-12', '27', '20451', 'kalaiya-05', '9745978315', 'InPatient', '2024-07-25 09:34:26.523731', 'Abdomen Paining', 'Re-Admit', 'Admit'),
(41, 'Uttam ', 'Ghimire', 'fe9956c402ac9b58256264348ecaf5ce825f445e', '123@gmail.com', 'man2.jpg', '2000-10-24', '24', '19222', 'Satdobato', '9801202140', 'OutPatient', '2024-07-25 11:00:41.053081', 'Blood Test ', NULL, NULL),
(42, 'Vijay', 'Pandit ', 'fe9956c402ac9b58256264348ecaf5ce825f445e', '1@gmail.com', 'man4.jpg', '2001-07-25', '23', '61802', 'Balkhu ', '9868567576', 'OutPatient', '2024-07-25 11:01:11.315652', 'Eye Problem', NULL, NULL),
(43, 'Sahadev', 'Khadka', 'fe9956c402ac9b58256264348ecaf5ce825f445e', '12@gmail.com', 'man5.jpg', '1997-05-25', '27', '30463', 'Kharibot', '9857052251', 'InPatient', '2024-07-25 11:02:14.496468', 'Ortho', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `his_patient_transfers`
--

CREATE TABLE `his_patient_transfers` (
  `t_id` int(20) NOT NULL,
  `t_hospital` varchar(200) DEFAULT NULL,
  `t_date` varchar(200) DEFAULT NULL,
  `t_pat_name` varchar(200) DEFAULT NULL,
  `t_pat_number` varchar(200) DEFAULT NULL,
  `t_status` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `his_patient_transfers`
--

INSERT INTO `his_patient_transfers` (`t_id`, `t_hospital`, `t_date`, `t_pat_name`, `t_pat_number`, `t_status`) VALUES
(10, 'ABC', '2024-06-09', 'Pradeep Chaudhary', '59217', 'Success');

-- --------------------------------------------------------

--
-- Table structure for table `his_payrolls`
--

CREATE TABLE `his_payrolls` (
  `pay_id` int(20) NOT NULL,
  `pay_number` varchar(200) DEFAULT NULL,
  `pay_doc_name` varchar(200) DEFAULT NULL,
  `pay_doc_number` varchar(200) DEFAULT NULL,
  `pay_doc_email` varchar(200) DEFAULT NULL,
  `pay_emp_salary` varchar(200) DEFAULT NULL,
  `pay_date_generated` timestamp(4) NOT NULL DEFAULT current_timestamp(4) ON UPDATE current_timestamp(4),
  `pay_status` varchar(200) DEFAULT NULL,
  `pay_descr` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `his_payrolls`
--

INSERT INTO `his_payrolls` (`pay_id`, `pay_number`, `pay_doc_name`, `pay_doc_number`, `pay_doc_email`, `pay_emp_salary`, `pay_date_generated`, `pay_status`, `pay_descr`) VALUES
(7, '418Z6', 'Pradeep Chaudhary', 'YQEG', 'Pradeepchaudhary30062@gmail.com', '2000', '2024-06-24 10:52:44.9766', 'PAID', '<p>This month salary</p>');

-- --------------------------------------------------------

--
-- Table structure for table `his_pharmaceuticals`
--

CREATE TABLE `his_pharmaceuticals` (
  `phar_id` int(20) NOT NULL,
  `phar_name` varchar(200) DEFAULT NULL,
  `phar_bcode` varchar(200) DEFAULT NULL,
  `phar_desc` longtext DEFAULT NULL,
  `phar_qty` varchar(200) DEFAULT NULL,
  `phar_cat` varchar(200) DEFAULT NULL,
  `phar_vendor` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `his_pharmaceuticals`
--

INSERT INTO `his_pharmaceuticals` (`phar_id`, `phar_name`, `phar_bcode`, `phar_desc`, `phar_qty`, `phar_cat`, `phar_vendor`) VALUES
(5, 'FLEXON', '649580137', '<p><strong>FLEXON</strong> is a brand name for a combination medication containing ibuprofen and paracetamol (acetaminophen). This medication is commonly used to relieve pain and reduce fever or inflammation. Here&#39;s a detailed overview:</p><p>Composition</p><ul><li><strong>Ibuprofen</strong>: A nonsteroidal anti-inflammatory drug (NSAID) that reduces inflammation, pain, and fever by inhibiting the production of prostaglandins.</li><li><strong>Paracetamol (Acetaminophen)</strong>: An analgesic and antipyretic that helps to relieve pain and reduce fever, likely by affecting the heat-regulating center of the brain and inhibiting the synthesis of prostaglandins.</li></ul><p>Uses</p><ul><li><strong>Pain Relief</strong>: Effective for mild to moderate pain, such as headaches, toothaches, muscle pain, and menstrual cramps.</li><li><strong>Fever Reduction</strong>: Helps lower fever.</li><li><strong>Inflammation Reduction</strong>: Ibuprofen component helps reduce inflammation in conditions such as arthritis.</li></ul><p>Dosage and Administration</p><ul><li>The dosage varies depending on the specific product formulation and patient factors such as age, weight, and severity of symptoms.</li><li>It&#39;s important to follow the dosage instructions provided by a healthcare professional or the product packaging to avoid potential side effects or overdose.</li></ul><p>Side Effects</p><ul><li><strong>Common Side Effects</strong>: May include nausea, vomiting, stomach pain, heartburn, and dizziness.</li><li><strong>Serious Side Effects</strong>: Potential for allergic reactions, gastrointestinal bleeding, liver damage (especially with high doses or prolonged use), and kidney damage.</li></ul><p>Precautions</p><ul><li><strong>Avoid Overuse</strong>: Long-term or excessive use can lead to serious health issues such as gastrointestinal bleeding, liver damage, and kidney problems.</li><li><strong>Alcohol</strong>: Avoid consuming alcohol while taking this medication, as it can increase the risk of liver damage (from paracetamol) and stomach bleeding (from ibuprofen).</li><li><strong>Pregnancy and Breastfeeding</strong>: Consult a healthcare provider before use, as it may not be safe during pregnancy or breastfeeding.</li><li><strong>Drug Interactions</strong>: Inform your healthcare provider about any other medications you are taking to avoid potential interactions.</li></ul><p>Contraindications</p><ul><li><strong>Allergies</strong>: Do not use if you are allergic to ibuprofen, paracetamol, or any other ingredients in the product.</li><li><strong>Ulcers or Bleeding Disorders</strong>: Not recommended for individuals with active gastrointestinal ulcers or bleeding disorders.</li><li><strong>Kidney or Liver Disease</strong>: Use with caution and under medical supervision if you have a history of kidney or liver disease.</li></ul><p>Brand and Availability</p><ul><li>FLEXON is available under various brand names and formulations in different regions. It can be found over-the-counter or by prescription, depending on the specific formulation and local regulations.</li></ul><p>Always consult a healthcare professional before starting any new medication, and use FLEXON as directed to ensure safe and effective treatment of pain and fever.</p>', '5', 'Antibiotics', 'Asian Pharmaceuticals Private LTD'),
(6, 'Decold', '129307465', '<p><strong>Decold</strong> is a brand name for a combination medication used to relieve symptoms associated with the common cold, flu, and other respiratory tract infections. The specific ingredients can vary, but typically, Decold contains a combination of the following active components:</p><p>Common Ingredients</p><ol><li><strong>Paracetamol (Acetaminophen)</strong>: An analgesic and antipyretic that helps relieve pain and reduce fever.</li><li><strong>Phenylephrine</strong>: A decongestant that helps reduce nasal congestion by constricting blood vessels in the nasal passages.</li><li><strong>Chlorpheniramine</strong>: An antihistamine that helps relieve allergy symptoms such as runny nose, sneezing, and watery eyes.</li></ol><p>Uses</p><ul><li><strong>Relief of Cold and Flu Symptoms</strong>: Effective in treating symptoms such as headache, fever, nasal congestion, runny nose, sneezing, and minor aches and pains.</li><li><strong>Allergy Relief</strong>: Helps manage symptoms of allergic reactions, such as itching, watery eyes, and sneezing.</li></ul><p>Dosage and Administration</p><ul><li>The dosage depends on the specific product formulation, age, weight, and severity of symptoms.</li><li>Typically taken every 4 to 6 hours, but it is essential to follow the instructions provided by a healthcare professional or the product packaging.</li></ul><p>Side Effects</p><ul><li><strong>Common Side Effects</strong>: Drowsiness, dizziness, dry mouth, nausea, and mild gastrointestinal discomfort.</li><li><strong>Serious Side Effects</strong>: Allergic reactions, such as rash, itching, swelling, severe dizziness, or difficulty breathing, should prompt immediate medical attention.</li></ul><p>Precautions</p><ul><li><strong>Drowsiness</strong>: The antihistamine component can cause drowsiness, so avoid driving or operating heavy machinery until you know how the medication affects you.</li><li><strong>Alcohol</strong>: Avoid consuming alcohol while taking Decold, as it can increase drowsiness and the risk of liver damage (from paracetamol).</li><li><strong>Pregnancy and Breastfeeding</strong>: Consult a healthcare provider before use, as certain ingredients may not be safe during pregnancy or breastfeeding.</li><li><strong>Medical Conditions</strong>: Inform your healthcare provider if you have any preexisting conditions, such as high blood pressure, heart disease, liver or kidney disease, diabetes, or thyroid disorders.</li></ul><p>Drug Interactions</p><ul><li>Decold can interact with other medications, such as monoamine oxidase inhibitors (MAOIs), certain antidepressants, and other cold or allergy medications. Inform your healthcare provider about any other medications or supplements you are taking.</li></ul><p>Contraindications</p><ul><li><strong>Allergies</strong>: Do not use if you are allergic to any of the ingredients in Decold.</li><li><strong>Certain Medical Conditions</strong>: Not recommended for individuals with certain medical conditions, such as severe high blood pressure, severe coronary artery disease, or glaucoma.</li></ul><p>Brand and Availability</p><ul><li>Decold is available under various formulations and brand names in different regions. It can be found over-the-counter or by prescription, depending on the specific formulation and local regulations.</li></ul><p>Always consult a healthcare professional before starting any new medication, and use Decold as directed to ensure safe and effective relief from cold and flu symptoms.</p>', '2', 'Antibacterials', 'National HealthCare Pvt. Ltd');

-- --------------------------------------------------------

--
-- Table structure for table `his_pharmaceuticals_categories`
--

CREATE TABLE `his_pharmaceuticals_categories` (
  `pharm_cat_id` int(20) NOT NULL,
  `pharm_cat_name` varchar(200) DEFAULT NULL,
  `pharm_cat_vendor` varchar(200) DEFAULT NULL,
  `pharm_cat_desc` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `his_pharmaceuticals_categories`
--

INSERT INTO `his_pharmaceuticals_categories` (`pharm_cat_id`, `pharm_cat_name`, `pharm_cat_vendor`, `pharm_cat_desc`) VALUES
(4, 'Antibacterials', 'Asian Pharmaceuticals Private LTD', '<p>Antibacterials, commonly referred to as antibiotics, are a class of drugs used to treat bacterial infections. They work by killing bacteria or inhibiting their growth. Here&#39;s an overview of their key aspects:</p><p>Types of Antibacterials</p><ol><li><strong>Beta-lactams</strong>: Includes penicillins, cephalosporins, carbapenems, and monobactams. They work by inhibiting cell wall synthesis.</li><li><strong>Macrolides</strong>: Such as erythromycin and azithromycin, inhibit protein synthesis by binding to the bacterial ribosome.</li><li><strong>Tetracyclines</strong>: Block the binding of tRNA to the ribosome, inhibiting protein synthesis.</li><li><strong>Aminoglycosides</strong>: Interfere with protein synthesis by binding to the bacterial ribosome, examples include gentamicin and streptomycin.</li><li><strong>Fluoroquinolones</strong>: Such as ciprofloxacin, inhibit DNA gyrase and topoisomerase IV, enzymes critical for DNA replication.</li><li><strong>Sulfonamides</strong>: Block folic acid synthesis, essential for bacterial growth.</li><li><strong>Glycopeptides</strong>: Such as vancomycin, inhibit cell wall synthesis in Gram-positive bacteria.</li><li><strong>Oxazolidinones</strong>: Like linezolid, inhibit protein synthesis by binding to the bacterial ribosome.</li></ol>'),
(5, 'Antibiotics', 'National HealthCare Pvt. Ltd', '<p>Antibiotics are a crucial class of medications used to treat bacterial infections. They can be classified based on their mechanism of action, chemical structure, or spectrum of activity. Here&rsquo;s a detailed look at antibiotics:</p><p>Mechanism of Action</p><ol><li><p><strong>Inhibitors of Cell Wall Synthesis</strong>:</p><ul><li><strong>Beta-lactams</strong>: Include penicillins (e.g., amoxicillin), cephalosporins (e.g., ceftriaxone), carbapenems (e.g., meropenem), and monobactams (e.g., aztreonam). They work by inhibiting the enzymes involved in cell wall synthesis.</li><li><strong>Glycopeptides</strong>: Such as vancomycin, inhibit cell wall synthesis by binding to peptidoglycan precursors.</li></ul></li><li><p><strong>Protein Synthesis Inhibitors</strong>:</p><ul><li><strong>Aminoglycosides</strong>: Such as gentamicin, bind to the bacterial ribosome and interfere with protein synthesis.</li><li><strong>Tetracyclines</strong>: Like doxycycline, block the attachment of tRNA to the ribosome.</li><li><strong>Macrolides</strong>: Such as erythromycin and azithromycin, bind to the ribosomal subunit and inhibit protein synthesis.</li><li><strong>Lincosamides</strong>: Like clindamycin, also inhibit protein synthesis by binding to the ribosome.</li><li><strong>Oxazolidinones</strong>: Such as linezolid, interfere with the initiation of protein synthesis.</li></ul></li><li><p><strong>Nucleic Acid Synthesis Inhibitors</strong>:</p><ul><li><strong>Quinolones/Fluoroquinolones</strong>: Such as ciprofloxacin, inhibit DNA gyrase and topoisomerase IV, enzymes involved in DNA replication.</li><li><strong>Rifamycins</strong>: Like rifampin, inhibit RNA polymerase, blocking RNA synthesis.</li></ul></li><li><p><strong>Metabolic Pathway Inhibitors</strong>:</p><ul><li><strong>Sulfonamides</strong>: Such as sulfamethoxazole, inhibit folic acid synthesis by blocking the enzyme dihydropteroate synthase.</li><li><strong>Trimethoprim</strong>: Inhibits dihydrofolate reductase, another enzyme involved in folic acid synthesis.</li></ul></li><li><p><strong>Cell Membrane Disruptors</strong>:</p><ul><li><strong>Polymyxins</strong>: Such as polymyxin B and colistin, interact with the phospholipids of the bacterial cell membrane, increasing its permeability.</li></ul></li></ol>');

-- --------------------------------------------------------

--
-- Table structure for table `his_prescriptions`
--

CREATE TABLE `his_prescriptions` (
  `pres_id` int(200) NOT NULL,
  `pres_pat_name` varchar(200) DEFAULT NULL,
  `pres_pat_age` varchar(200) DEFAULT NULL,
  `pres_pat_number` varchar(200) DEFAULT NULL,
  `pres_number` varchar(200) DEFAULT NULL,
  `pres_pat_addr` varchar(200) DEFAULT NULL,
  `pres_pat_type` varchar(200) DEFAULT NULL,
  `pres_date` timestamp(4) NOT NULL DEFAULT current_timestamp(4) ON UPDATE current_timestamp(4),
  `pres_pat_ailment` varchar(200) DEFAULT NULL,
  `pres_ins` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `his_prescriptions`
--

INSERT INTO `his_prescriptions` (`pres_id`, `pres_pat_name`, `pres_pat_age`, `pres_pat_number`, `pres_number`, `pres_pat_addr`, `pres_pat_type`, `pres_date`, `pres_pat_ailment`, `pres_ins`) VALUES
(11, 'Kanchan Chaudhary', '27', '29978', 'F1RVB', 'Nijgadh', 'OutPatient', '2024-07-25 11:44:05.1731', 'Gastric Problem', '<p>1. <strong>Gastritis</strong></p><ul><li><strong>Proton Pump Inhibitors (PPIs)</strong>:<ul><li><strong>Omeprazole</strong> 20 mg, once daily before breakfast.</li></ul></li><li><strong>Antacids</strong>:<ul><li><strong>Tums</strong> (calcium carbonate) 500 mg, as needed for heartburn.</li></ul></li><li><strong>H2-Receptor Antagonists</strong>:<ul><li><strong>Ranitidine</strong> 150 mg, twice daily.</li></ul></li></ul><p>2. <strong>Peptic Ulcer Disease</strong></p><ul><li><strong>PPIs</strong>:<ul><li><strong>Esomeprazole</strong> 40 mg, once daily.</li></ul></li><li><strong>Antibiotics</strong> (for H. pylori infection):<ul><li><strong>Amoxicillin</strong> 1 g, twice daily.</li><li><strong>Clarithromycin</strong> 500 mg, twice daily.</li><li><strong>Metronidazole</strong> 500 mg, twice daily.</li></ul></li><li><strong>Bismuth Subsalicylate</strong>:<ul><li><strong>Pepto-Bismol</strong> 262 mg, every 30 minutes to 1 hour as needed, up to 8 doses per day.</li></ul></li></ul><p>3. <strong>Acid Reflux (GERD)</strong></p><ul><li><strong>PPIs</strong>:<ul><li><strong>Lansoprazole</strong> 30 mg, once daily before breakfast.</li></ul></li><li><strong>H2-Receptor Antagonists</strong>:<ul><li><strong>Famotidine</strong> 20 mg, twice daily.</li></ul></li><li><strong>Antacids</strong>:<ul><li><strong>Maalox</strong> or <strong>Mylanta</strong> as needed for relief.</li></ul></li></ul><p>4. <strong>Irritable Bowel Syndrome (IBS)</strong></p><ul><li><strong>Antispasmodics</strong>:<ul><li><strong>Hyoscamine</strong> 0.125 mg, every 4 to 8 hours as needed.</li></ul></li><li><strong>Fiber Supplements</strong>:<ul><li><strong>Psyllium</strong> (Metamucil) 1 tablespoon, once to three times daily.</li></ul></li><li><strong>Antidiarrheals</strong> (for diarrhea-predominant IBS):<ul><li><strong>Loperamide</strong> 2 mg, as needed.</li></ul></li></ul><p>5. <strong>Peptic Ulcer Disease with H. pylori</strong></p><ul><li><strong>Triple Therapy</strong>:<ul><li><strong>Omeprazole</strong> 20 mg, twice daily.</li><li><strong>Amoxicillin</strong> 1 g, twice daily.</li><li><strong>Clarithromycin</strong> 500 mg, twice daily.</li><li><strong>Metronidazole</strong> 500 mg, twice daily.</li></ul></li><li><strong>Bismuth Subsalicylate</strong>:<ul><li><strong>Pepto-Bismol</strong> 262 mg, every 30 minutes to 1 hour as needed, up to 8 doses per day.</li></ul></li></ul><p>6. <strong>Gastroenteritis (Stomach Flu)</strong></p><ul><li><strong>Rehydration Solutions</strong>:<ul><li><strong>Oral Rehydration Solutions</strong> (e.g., Pedialyte) as directed.</li></ul></li><li><strong>Anti-nausea</strong>:<ul><li><strong>Ondansetron</strong> 4 mg, every 8 hours as needed.</li></ul></li></ul><p>7. <strong>Functional Dyspepsia</strong></p><ul><li><strong>PPIs</strong>:<ul><li><strong>Rabeprazole</strong> 20 mg, once daily.</li></ul></li><li><strong>Antacids</strong>:<ul><li><strong>Maalox</strong> or <strong>Rolaids</strong> as needed for relief.</li></ul></li></ul><p>General Lifestyle and Dietary Recommendations</p><ul><li><strong>Avoid Irritants</strong>: Reduce intake of spicy, fatty, or acidic foods.</li><li><strong>Eat Smaller, Frequent Meals</strong>: To avoid excessive stomach acid production.</li><li><strong>Stay Hydrated</strong>: Drink plenty of water.</li><li><strong>Avoid Smoking and Alcohol</strong>: Both can exacerbate gastric symptoms.</li></ul>');

-- --------------------------------------------------------

--
-- Table structure for table `his_pwdresets`
--

CREATE TABLE `his_pwdresets` (
  `id` int(20) NOT NULL,
  `email` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `his_surgery`
--

CREATE TABLE `his_surgery` (
  `s_id` int(200) NOT NULL,
  `s_number` varchar(200) DEFAULT NULL,
  `s_doc` varchar(200) DEFAULT NULL,
  `s_doc_number` varchar(100) DEFAULT NULL,
  `s_pat_number` varchar(200) DEFAULT NULL,
  `s_pat_name` varchar(200) DEFAULT NULL,
  `s_pat_ailment` varchar(200) DEFAULT NULL,
  `s_pat_date` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `s_pat_status` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `his_surgery`
--

INSERT INTO `his_surgery` (`s_id`, `s_number`, `s_doc`, `s_doc_number`, `s_pat_number`, `s_pat_name`, `s_pat_ailment`, `s_pat_date`, `s_pat_status`) VALUES
(15, '63QCO', 'Dipesh Chaudhary', NULL, '20451', 'Nirajan Chaudhary', 'Abdomen Paining', '2024-06-22 14:25:07.061590', 'Successful'),
(16, 'AHT0J', 'Dipesh Chaudhary', NULL, '16144', 'Pradeep Chaudhary', 'Abdomen', '2024-07-24 09:04:01.381444', 'Undergoing');

-- --------------------------------------------------------

--
-- Table structure for table `his_vendor`
--

CREATE TABLE `his_vendor` (
  `v_id` int(20) NOT NULL,
  `v_number` varchar(200) DEFAULT NULL,
  `v_name` varchar(200) DEFAULT NULL,
  `v_adr` varchar(200) DEFAULT NULL,
  `v_mobile` varchar(200) DEFAULT NULL,
  `v_email` varchar(200) DEFAULT NULL,
  `v_phone` varchar(200) DEFAULT NULL,
  `v_desc` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `his_vendor`
--

INSERT INTO `his_vendor` (`v_id`, `v_number`, `v_name`, `v_adr`, `v_mobile`, `v_email`, `v_phone`, `v_desc`) VALUES
(3, 'N0VQH', 'Asian Pharmaceuticals Private LTD', 'Rupandehi', NULL, 'asianpharma@gmail.com', '0535544025', '<p>Asian Pharmaceuticals Private Limited (ASP) is one of Nepal&rsquo;s premier manufacturers of prescription and non-prescription drugs.</p><p>Their manufacturing facility is situated in Padasari VDC-9, Siddhartha Nagar, Rupandehi, Nepal. ASP manufactures over 240 different medicines of the highest quality to help save and improve the lives of millions of people in Nepal.&nbsp;</p>'),
(4, 'YRAS8', 'National HealthCare Pvt. Ltd', 'Birgunj, Parsa', NULL, 'fdho@nationalhealthcare.com.np', '051-521478', '<p>For the Total Care of Your Health</p><p>National Healthcare always places consumers at the center of our attention, and concentrate on improving their experience with the aid of latest technologies.</p><p>They&nbsp; are the industry leader in Nepalese market.</p><p>Their team puts heart and mind into quality control.</p><p>They&nbsp;are operating 10+ divisions under same roof.</p>');

-- --------------------------------------------------------

--
-- Table structure for table `his_vitals`
--

CREATE TABLE `his_vitals` (
  `vit_id` int(20) NOT NULL,
  `vit_number` varchar(200) DEFAULT NULL,
  `vit_pat_number` varchar(200) DEFAULT NULL,
  `vit_bodytemp` varchar(200) DEFAULT NULL,
  `vit_heartpulse` varchar(200) DEFAULT NULL,
  `vit_resprate` varchar(200) DEFAULT NULL,
  `vit_bloodpress` varchar(200) DEFAULT NULL,
  `vit_daterec` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `his_vitals`
--

INSERT INTO `his_vitals` (`vit_id`, `vit_number`, `vit_pat_number`, `vit_bodytemp`, `vit_heartpulse`, `vit_resprate`, `vit_bloodpress`, `vit_daterec`) VALUES
(6, 'MS2OJ', '4TLG0', '37', '70', '15', '120/80', '2022-10-22 11:01:52.148658'),
(7, 'U68RH', '59217', '56', '80', '128', '120', '2024-06-22 09:55:21.750762'),
(8, '96XRE', 'YQEG', '56', '80', '128', '120', '2024-06-22 10:37:25.385725'),
(9, 'RK9T3', '16144', '56', '80', '128', '120', '2024-06-23 12:50:36.742674');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`);

--
-- Indexes for table `his_accounts`
--
ALTER TABLE `his_accounts`
  ADD PRIMARY KEY (`acc_id`);

--
-- Indexes for table `his_admin`
--
ALTER TABLE `his_admin`
  ADD PRIMARY KEY (`ad_id`);

--
-- Indexes for table `his_assets`
--
ALTER TABLE `his_assets`
  ADD PRIMARY KEY (`asst_id`);

--
-- Indexes for table `his_bills`
--
ALTER TABLE `his_bills`
  ADD PRIMARY KEY (`bill_id`);

--
-- Indexes for table `his_docs`
--
ALTER TABLE `his_docs`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `his_equipments`
--
ALTER TABLE `his_equipments`
  ADD PRIMARY KEY (`eqp_id`);

--
-- Indexes for table `his_laboratory`
--
ALTER TABLE `his_laboratory`
  ADD PRIMARY KEY (`lab_id`);

--
-- Indexes for table `his_medical_records`
--
ALTER TABLE `his_medical_records`
  ADD PRIMARY KEY (`mdr_id`);

--
-- Indexes for table `his_patients`
--
ALTER TABLE `his_patients`
  ADD PRIMARY KEY (`pat_id`);

--
-- Indexes for table `his_patient_transfers`
--
ALTER TABLE `his_patient_transfers`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `his_payrolls`
--
ALTER TABLE `his_payrolls`
  ADD PRIMARY KEY (`pay_id`);

--
-- Indexes for table `his_pharmaceuticals`
--
ALTER TABLE `his_pharmaceuticals`
  ADD PRIMARY KEY (`phar_id`);

--
-- Indexes for table `his_pharmaceuticals_categories`
--
ALTER TABLE `his_pharmaceuticals_categories`
  ADD PRIMARY KEY (`pharm_cat_id`);

--
-- Indexes for table `his_prescriptions`
--
ALTER TABLE `his_prescriptions`
  ADD PRIMARY KEY (`pres_id`);

--
-- Indexes for table `his_pwdresets`
--
ALTER TABLE `his_pwdresets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `his_surgery`
--
ALTER TABLE `his_surgery`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `his_vendor`
--
ALTER TABLE `his_vendor`
  ADD PRIMARY KEY (`v_id`);

--
-- Indexes for table `his_vitals`
--
ALTER TABLE `his_vitals`
  ADD PRIMARY KEY (`vit_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `his_accounts`
--
ALTER TABLE `his_accounts`
  MODIFY `acc_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `his_admin`
--
ALTER TABLE `his_admin`
  MODIFY `ad_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `his_assets`
--
ALTER TABLE `his_assets`
  MODIFY `asst_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `his_bills`
--
ALTER TABLE `his_bills`
  MODIFY `bill_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `his_docs`
--
ALTER TABLE `his_docs`
  MODIFY `doc_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `his_equipments`
--
ALTER TABLE `his_equipments`
  MODIFY `eqp_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `his_laboratory`
--
ALTER TABLE `his_laboratory`
  MODIFY `lab_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `his_medical_records`
--
ALTER TABLE `his_medical_records`
  MODIFY `mdr_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `his_patients`
--
ALTER TABLE `his_patients`
  MODIFY `pat_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `his_patient_transfers`
--
ALTER TABLE `his_patient_transfers`
  MODIFY `t_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `his_payrolls`
--
ALTER TABLE `his_payrolls`
  MODIFY `pay_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `his_pharmaceuticals`
--
ALTER TABLE `his_pharmaceuticals`
  MODIFY `phar_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `his_pharmaceuticals_categories`
--
ALTER TABLE `his_pharmaceuticals_categories`
  MODIFY `pharm_cat_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `his_prescriptions`
--
ALTER TABLE `his_prescriptions`
  MODIFY `pres_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `his_pwdresets`
--
ALTER TABLE `his_pwdresets`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `his_surgery`
--
ALTER TABLE `his_surgery`
  MODIFY `s_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `his_vendor`
--
ALTER TABLE `his_vendor`
  MODIFY `v_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `his_vitals`
--
ALTER TABLE `his_vitals`
  MODIFY `vit_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
