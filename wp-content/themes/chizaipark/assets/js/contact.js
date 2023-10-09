document.addEventListener('DOMContentLoaded', function() {
  var steps = document.querySelectorAll('.contactStep li');
  for (var i = 1; i < steps.length; i++) {
    steps[i].classList.remove('active');
  }
  document.addEventListener('wpcf7submit', function(event) {
    steps[0].classList.remove('active');
    steps[1].classList.add('active');
  }, false);
});
