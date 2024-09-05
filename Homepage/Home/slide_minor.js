document.getElementById('next').onclick = function(){
    let lists = document.querySelectorAll('.item');
    document.getElementById('slide').appendChild(lists[0]);
  }
  document.getElementById('prev').onclick = function(){
    let lists = document.querySelectorAll('.item');
    document.getElementById('slide').prepend(lists[lists.length - 1]);
  }
  let currentIndex = 0;
  const intervalTime = 3000; //  3 seconds
  
  function slideNext() {
    let lists = document.querySelectorAll('.item');
    document.getElementById('slide').appendChild(lists[0]);
    currentIndex = (currentIndex + 1) % lists.length;
  }
  
  function slidePrev() {
    let lists = document.querySelectorAll('.item');
    document.getElementById('slide').prepend(lists[lists.length - 1]);
    currentIndex = (currentIndex - 1 + lists.length) % lists.length;
  }
  
  document.getElementById('next').onclick = slideNext;
  document.getElementById('prev').onclick = slidePrev;
  
  // Automatically slide every 3 seconds
  setInterval(slideNext, intervalTime);
  