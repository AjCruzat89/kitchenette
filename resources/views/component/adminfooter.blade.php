<!--===============================================================================================-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<!--===============================================================================================-->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<!--===============================================================================================-->
<script>
    AOS.init();
</script>
<!--===============================================================================================-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!--===============================================================================================-->
<script src="{{asset('./js/admin.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>document.addEventListener('DOMContentLoaded', function() {
  const ctx = document.getElementById('dailySalesChart').getContext('2d');
  const dailySalesData = {
      labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
      datasets: [{
          label: 'Daily Sales',
          data: [120, 210, 180, 260, 320, 280, 200],
          backgroundColor: 'rgba(54, 162, 235, 0.2)',
          borderColor: 'rgba(54, 162, 235, 1)',
          borderWidth: 1
      }]
  };
  const dailySalesChart = new Chart(ctx, {
      type: 'bar',
      data: dailySalesData,
      options: {
          maintainAspectRatio: false,
          responsive: true, 
          scales: {
              y: {
                  beginAtZero: true
              }
          }
      }
  });
});</script>
</body>

</html>