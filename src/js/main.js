var Jobinput = document.getElementById('jobSearch');
var Jobul = document.getElementById("jobs-list");
var Jobli = Jobul.getElementsByClassName('job-item');

Jobinput.addEventListener('keyup', function() {
  var filter = this.value.toUpperCase();
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
    var city = Jobli[i].getElementsByClassName('city');
    for (var c = 0; c < city.length; c++) {
      var txtValue = city[c].textContent || city[c].innerText;
    }
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      Jobli[i].style.display = "";
    } else {
      Jobli[i].style.display = "none";
    }
  }
});

var Cityradio = document.querySelectorAll('.radio_city');
Cityradio.forEach((elem) => {
  elem.addEventListener('change', function() {
    var filter = this.value;
    for (var i = 0; i < Jobli.length; i++) {
      var city = Jobli[i].getElementsByClassName('city');
      for (var c = 0; c < city.length; c++) {
        var radioValue = city[c].getAttribute('data-city');
      }
      if (radioValue.indexOf(filter) > -1) {
        Jobli[i].style.display = "";
      } else {
        Jobli[i].style.display = "none";
      }
    }
  });
});

var checkboxTime = document.getElementById('full-time');
checkboxTime.addEventListener('change', function() {
  for (var i = 0; i < Jobli.length; i++) {
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
});


