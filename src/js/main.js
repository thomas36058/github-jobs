var body = document.querySelector('body');

if(body.classList.contains('home')) {
  var Jobinput = document.getElementById('jobSearch');
  var JobSearchButton = document.getElementById('jobSearchButton');
  var Jobul = document.getElementById("jobs-list");
  var Jobli = Jobul.getElementsByClassName('job-item');

  JobSearchButton.addEventListener('click', function() {
    var filter = Jobinput.value.toUpperCase();
    for (var i = 0; i < Jobli.length; i++) {
      var a = Jobli[i].getElementsByTagName("a")[0];
      var txtValue = a.textContent || a.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        Jobli[i].style.display = "";
      } else {
        Jobli[i].style.display = "none";
      }
    }
  });

  var Cityinput = document.getElementById('citySearch');
  Cityinput.addEventListener('keyup', function() {
    var filter = this.value.toUpperCase();
    for (var i = 0; i < Jobli.length; i++) {
      var cities = Jobli[i].getElementsByClassName("city_name");
      Jobli[i].style.display = "none";
      Jobli[i].classList.remove('searching');
      for (var c = 0; c < cities.length; c++) {
        if(cities[c].textContent.toUpperCase().includes(filter)) {
          Jobli[i].style.display = "block";
          Jobli[i].classList.add('searching');
        }
      }
    }
  });

  var Cityradio = document.querySelectorAll('.radio_city');
  Cityradio.forEach((elem) => {
    elem.addEventListener('change', function() {
      var filter = this.value.toUpperCase();
      for (var i = 0; i < Jobli.length; i++) {
        var cities = Jobli[i].getElementsByClassName('city_name');  
        Jobli[i].style.display = "none";
        Jobli[i].classList.remove('searching');
        for (var c = 0; c < cities.length; c++) {
          var radioValue = cities[c].getAttribute('data-city').toUpperCase().includes(filter);
          if (radioValue) {
            Jobli[i].style.display = "block";
            Jobli[i].classList.add('searching');
          }
        }
      }
    });
  });

  var checkboxTime = document.getElementById('full-time');
  checkboxTime.addEventListener('change', function() {
    for (var i = 0; i < Jobli.length; i++) {
      if( Jobli[i].classList.contains('searching') ) {
        Jobli[i].style.display = 'none';
        if( !checkboxTime.checked ) {
          Jobli[i].style.display = '';
        }
        var Jobtime = Jobli[i].getElementsByClassName('time');
        for (var c = 0; c < Jobtime.length; c++) {
          var data_time = Jobtime[c].getAttribute('data-time');
          if( data_time == 'full-time' ) {
            Jobli[i].style.display = "";
          } else {
            Jobli[i].style.display = "none";
          }
        }   
      }
    }
  });

}