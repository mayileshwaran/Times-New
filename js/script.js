$(document).ready(function(){
    $('.tabs-nav li').click(function(){
      var tab_id = $(this).data('tab');

      $('.tabs-nav li').removeClass('active');
      $('.tab-content').removeClass('active');

      $(this).addClass('active');
      $("#" + tab_id).addClass('active');
    });
  });
  $(document).ready(function () {
    $('.set-heading').click(function () {
        if ($(this).hasClass('active')) {
            $(this).removeClass('active')
            $(this).siblings('.set-container').slideUp(700);
            $('.set-heading span i').removeClass('fa-minus').addClass('fa-plus');
        }
        else {
            $('.set-heading span i').removeClass('fa-minus').addClass('fa-plus');
            $(this).find('i').removeClass('fa-plus').addClass('fa-minus');

            $('.set-heading').removeClass('active');
            $(this).addClass('active');

            $('.set-container').slideUp(700);
            $(this).siblings('.set-container').slideDown(700)
        }
    })
});
$(document).ready(function(){
    let carouselItem=$('.carousel-item')
    carouselItem.first().addClass('active');
    
    let currIndex=0;
    let carouselLength=carouselItem.length;
    carouselItem.first().addClass('active')

    function showItem(currInd){
        carouselItem.removeClass('active')
        carouselItem.eq(currInd).addClass('active');
    }
    $('.carousel-prev-indicator').click(function(){
        currIndex=(currIndex-1)% carouselLength;
        showItem(currIndex);
    })
    $('.carousel-next-indicator').click(function(){
        currIndex=(currIndex+1)% carouselLength;
        showItem(currIndex);
    })
    function autoplay(){
         currIndex=(currIndex+1) % carouselItem.length;
        currIndex=(currIndex+1) % carouselLength;
        showItem(currIndex);
    }
    setInterval(autoplay,5000)

})
$(document).ready(function () {
  // Set future date: 70 days 12h 35m 60s from now
  const now = new Date();
  const future = new Date(now.getTime() + (5 * 24 * 60 * 60 + 5 * 3600 + 35 * 60 + 60) * 1000);

  function updateCountdown() {
    const currentTime = new Date().getTime();
    const distance = future.getTime() - currentTime;

    if (distance <= 0) {
      $('#days, #hours, #minutes, #seconds').text('00');
      return;
    }

    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

    $('#days').text(String(days).padStart(2, '0'));
    $('#hours').text(String(hours).padStart(2, '0'));
    $('#minutes').text(String(minutes).padStart(2, '0'));
    $('#seconds').text(String(seconds).padStart(2, '0'));
  }

  updateCountdown();
  setInterval(updateCountdown, 1000);
});
    $(document).ready(function(){
            $('.open-popup').click(function(){
                $('#popup').fadeIn();
            });
            $('#confirm').click(function(){
                alert('confirmed');
                $('#popup').fadeOut();
            })
            $('#cancel').click(function(){
              
                $('#popup').fadeOut();
            })
        });   

//Form validation
document.getElementById('submitBtn').addEventListener('click', function () {
    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    const phone = document.getElementById('phone').value.trim();
    const message = document.getElementById('message').value.trim();
    const formMessage = document.getElementById('formMessage');

    const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
    const phonePattern = /^[6-9][0-9]{9}$/;
    const namePattern = /^[A-Za-z\s]+$/;
    const messagePattern = /^[A-Za-z0-9\s.,!?]+$/;

    if (name === '') {
        formMessage.style.color = 'red';
        formMessage.textContent = 'Please enter your name.';
    } else if (!namePattern.test(name)) {
        formMessage.style.color = 'red';
        formMessage.textContent = 'Name should only contain letters and spaces.';
    } else if (email === '') {
        formMessage.style.color = 'red';
        formMessage.textContent = 'Please enter your email.';
    } else if (!emailPattern.test(email)) {
        formMessage.style.color = 'red';
        formMessage.textContent = 'Please enter a valid email address.';
    } else if (phone === '') {
        formMessage.style.color = 'red';
        formMessage.textContent = 'Please enter your phone number.';
    } else if (!phonePattern.test(phone)) {
        formMessage.style.color = 'red';
        formMessage.textContent = 'Phone number must start with 9, 8, 7, or 6 and be 10 digits.';
    } else if (message === '') {
        formMessage.style.color = 'red';
        formMessage.textContent = 'Please enter your message.';
    } else if (!messagePattern.test(message)) {
        formMessage.style.color = 'red';
        formMessage.textContent = 'Message can only contain letters, numbers, spaces, and . , ! ?';
    } else {
        // Valid case
        setTimeout(() => {
            formMessage.style.color = 'green';
            formMessage.textContent = 'Form submitted successfully!';
            document.getElementById('contactForm').reset();

            setTimeout(() => {
                formMessage.textContent = '';
            }, 10000);
        }, 1000);
    }
});
