<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Exchange Rates</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f9fc;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 5px;
        }

        .subtitle {
            text-align: center;
            font-size: 14px;
            color: #777;
            margin-bottom: 20px;
        }

        .top-bar {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .top-bar label {
            font-weight: bold;
            font-size: 16px;
            color: #333;
        }

        .top-bar input {
            padding: 8px 12px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        .rates-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 15px;
        }

        .rate-card {
            background: white;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            text-align: center;
            transition: transform 0.2s ease;
        }

        .rate-card:hover {
            transform: translateY(-2px);
        }

        .currency-pair {
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 8px;
            color: #444;
        }

        .rate-value {
            font-size: 20px;
            color: #2a9d8f;
        }

        .rate-date {
            font-size: 12px;
            color: #777;
            margin-top: 5px;
        }

        .no-data {
            text-align: center;
            color: #ccc;
            font-size: 24px;
            margin-top: 50px;
            font-style: italic;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Exchange Rates</h1>
    <div class="subtitle">All rates are based on USD</div>

    <div class="top-bar">
        <label for="rateDate" id="ratesTitle">Rates as of {{ now()->toDateString() }}</label>
        <input type="date" id="rateDate" value="{{ now()->toDateString() }}">
    </div>

    <div id="ratesContainer" class="rates-grid">
        <!-- Rates will load here -->
    </div>

    <div id="noDataMessage" class="no-data" style="display:none;">
        No rates found for this date.
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const rateDate = document.getElementById('rateDate');
        const ratesContainer = document.getElementById('ratesContainer');
        const noDataMessage = document.getElementById('noDataMessage');
        const ratesTitle = document.getElementById('ratesTitle');

        function fetchRates(date) {
            fetch(`/api/rates/${date}`)
                .then(res => res.json())
                .then(data => {
                    ratesContainer.innerHTML = '';
                    ratesTitle.textContent = `Rates for ${date}`;

                    if (!data || data.length === 0) {
                        noDataMessage.style.display = 'block';
                        return;
                    }

                    noDataMessage.style.display = 'none';
                    data.forEach(rate => {
                        const card = document.createElement('div');
                        card.className = 'rate-card';
                        card.innerHTML = `
                            <div class="currency-pair">${rate.target}</div>
                            <div class="rate-value">${rate.rate}</div>
                        `;
                        ratesContainer.appendChild(card);
                    });
                })
                .catch(err => {
                    console.error('Error fetching rates:', err);
                });
        }

        // Initial load
        fetchRates(rateDate.value);

        // On date change
        rateDate.addEventListener('change', function () {
            fetchRates(this.value);
        });
    });
</script>

</body>
</html>
