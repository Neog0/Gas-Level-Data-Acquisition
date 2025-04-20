<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Gas Level Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body {
      background: linear-gradient(to right, #f8f9fa, #e9ecef);
    }

    .card {
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08);
      border-radius: 15px;
    }

    .status-indicator {
      display: inline-block;
      width: 12px;
      height: 12px;
      border-radius: 50%;
      margin-right: 8px;
    }

    .status-safe {
      background-color: #28a745 !important;
    }

    .status-danger {
      background-color: #dc3545 !important;
    }

    .status-warning {
      background-color: #ffc107 !important;
    }

    #liveIndicator {
      width: 12px;
      height: 12px;
      border-radius: 50%;
      margin-left: 10px;
      background-color: gray;
      animation: pulse 5s infinite;
    }

    /* 👇 Add this to your CSS */
    @keyframes blink {
      0% {
        opacity: 1;
      }

      50% {
        opacity: 0;
      }

      100% {
        opacity: 1;
      }
    }

    /* 👇 This class will make anything blink */
    .blink {
      animation: blink 1s infinite;
    }
  </style>
  <script>
    function toggleRecordTable() {
      const table = document.getElementById('recordTable');
      table.style.display = (table.style.display === 'none') ? 'block' : 'none';
    }
  </script>
</head>

<body>
  <div class="container py-5">
    <h2 class="mb-5 text-center text-primary">🔍 Industrial Gas Monitoring Dashboard</h2>

    <!-- Status Panel -->
    <div class="card mb-4">
      <div class="card-body">
        <h5 class="card-title text-secondary">📊 Most Recent Data</h5>
        <p><strong>Gas Value:</strong> <span id="gasValue">--</span></p>
        <p>
          <strong>Status:</strong>
          <span class="status-indicator" id="statusIndicator"></span>
          <span id="gasStatus">--</span>
        <div id="lastUpdated" class="text-sm text-muted mt-2">Last updated: --</div>
        <div id="liveIndicator" title="Live indicator"></div>
        </p>
      </div>
    </div>

    <!-- Line Chart -->
    <div class="card mb-4">
      <div class="card-body">
        <h5 class="card-title text-secondary">📈 Live Gas Level Chart</h5>
        <canvas id="gasChart" height="100"></canvas>
      </div>
    </div>

    <div class="card mb-4">
      <div class="card-body">
        <h5 class="card-title text-primary">📋 Summary Report</h5>
        <div class="row text-center">
          <div class="col-md-4 mb-3">
            <div class="p-3 bg-light rounded shadow-sm">
              <h6 class="text-secondary">📈 Total Readings</h6>
              <h4 id="totalReadings" class="text-dark">--</h4>
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <div class="p-3 bg-success-subtle rounded shadow-sm">
              <h6 class="text-success">🔺 Max Value</h6>
              <h4 id="maxValue">--</h4>
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <div class="p-3 bg-info-subtle rounded shadow-sm">
              <h6 class="text-info">🔻 Min Value</h6>
              <h4 id="minValue">--</h4>
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <div class="p-3 bg-warning-subtle rounded shadow-sm">
              <h6 class="text-warning">📊 Average</h6>
              <h4 id="avgValue">--</h4>
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <div class="p-3 bg-warning rounded text-dark shadow-sm">
              <h6>⚠️ Unstable</h6>
              <h4 id="unstableCount">--</h4>
            </div>
          </div>
          <div class="col-md-6 offset-md-3 mb-3">
            <div class="p-3 bg-danger rounded text-white shadow-sm">
              <h6>🚨 Danger</h6>
              <h4 id="dangerCount">--</h4>
            </div>
          </div>
        </div>
      </div>
    </div>


    <!-- Buttons Row -->
    <div class="d-flex gap-2 mb-4">
      <!-- Toggle Button -->
      <button class="btn btn-outline-primary" onclick="toggleRecordTable()">
        📑 Show/Hide Recent Readings
      </button>

      <!-- Download CSV Button -->
      <button class="btn btn-outline-success" onclick="window.location.href='download_csv.php'">
        📥 Download CSV
      </button>
    </div>


    <!-- Record Table -->
    <div class="card" id="recordTable" style="display: none;">
      <div class="card-body">
        <h5 class="card-title text-secondary">📋 Recent Readings</h5>
        <?php
        $link = mysqli_connect("localhost", "root", "", "gas");
        $query = "SELECT * FROM gas_level ORDER BY timestamp DESC LIMIT 20";
        $result = mysqli_query($link, $query);
        ?>
        <table class="table table-hover table-bordered">
          <thead class="table-light">
            <tr>
              <th>ID</th>
              <th>Gas Value</th>
              <th>Status</th>
              <th>Timestamp</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
              <tr>
                <td><?php echo $row['ID']; ?></td>
                <td><?php echo $row['gas_value']; ?></td>
                <td><?php echo $row['status']; ?></td>
                <td><?php echo $row['timestamp']; ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- JS for Chart + Status Updates -->
  <script>
    const ctx = document.getElementById('gasChart').getContext('2d');
    const gasChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: [],
        datasets: [{
          label: 'Gas Level',
          data: [],
          borderColor: 'rgb(255, 99, 132)',
          tension: 0.2,
          fill: false,
          pointRadius: 2
        }]
      },
      options: {
        responsive: true,
        animation: false,
        scales: {
          x: {
            display: true,
            title: { display: true, text: 'Time' },
            ticks: {
              maxRotation: 0,
              minRotation: 0,
              autoSkip: true
            }
          },
          y: {
            beginAtZero: true,
            title: { display: true, text: 'Gas Value' }
          }
        },
        plugins: {
          legend: {
            labels: { color: '#333' }
          }
        }
      }
    });

    let previousStatus = null;
    let blinkTimeout = null;

    function updateChart() {
      fetch('chart_data.php')
        .then(response => response.json())
        .then(data => {
          const labels = data.chart_data.map(row => row.timestamp);
          const values = data.chart_data.map(row => row.gas_value);

          gasChart.data.labels = labels;
          gasChart.data.datasets[0].data = values;
          gasChart.update();

          // Get current value and timestamp
          const current = data.current || {};
          const gasValue = parseInt(current.gas_value) || 0;
          const timestamp = current.timestamp || null;

          document.getElementById('gasValue').textContent = gasValue;

          let gasStatus = 'Unknown';
          if (gasValue < 150) gasStatus = 'Safe';
          else if (gasValue < 250) gasStatus = 'Unstable';
          else gasStatus = 'Gas Detected';

          document.getElementById('gasStatus').textContent = gasStatus;

          const indicator = document.getElementById("statusIndicator");

          // Only update blink if status actually changed
          if (gasStatus !== previousStatus) {
            // Clear previous blink removal if it exists
            if (blinkTimeout) clearTimeout(blinkTimeout);

            // Reset classes
            indicator.className = "status-indicator";

            // Add new classes based on status
            if (gasStatus === "Gas Detected") {
              indicator.classList.add("status-danger", "blink");
            } else if (gasStatus === "Unstable") {
              indicator.classList.add("status-warning", "blink");
            } else {
              indicator.classList.add("status-safe");
            }

            // Remove blink after 5s
            blinkTimeout = setTimeout(() => {
              indicator.classList.remove("blink");
            }, 5000);

            // Update previous status
            previousStatus = gasStatus;
          }

          const liveDot = document.getElementById('liveIndicator');
          if (timestamp) {
            document.getElementById('lastUpdated').textContent = "Last updated: " + timestamp;
            const now = new Date();
            const updated = new Date(timestamp);
            const secondsAgo = (now - updated) / 1000;

            if (secondsAgo < 15) liveDot.style.backgroundColor = "green";
            else if (secondsAgo < 60) liveDot.style.backgroundColor = "yellow";
            else liveDot.style.backgroundColor = "gray";
          } else {
            document.getElementById('lastUpdated').textContent = "Last updated: --";
            liveDot.style.backgroundColor = "gray";
          }
        })
        .catch(error => console.error('Error fetching data:', error));
    }

    setInterval(updateChart, 1000);
    updateChart();

    function updateSummary() {
      fetch('summary_data.php')
        .then(response => response.json())
        .then(data => {
          document.getElementById('totalReadings').textContent = data.total;
          document.getElementById('maxValue').textContent = data.max;
          document.getElementById('minValue').textContent = data.min;
          document.getElementById('avgValue').textContent = data.avg;
          document.getElementById('unstableCount').textContent = data.unstable;
          document.getElementById('dangerCount').textContent = data.danger;
        })
        .catch(error => console.error('Error fetching summary:', error));
    }

    setInterval(updateSummary, 5000);
    updateSummary();

  </script>
</body>

</html>