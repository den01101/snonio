<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Shape Area Calculator</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <!-- Styles -->
    <style>
        body {
            font-family: 'instrument-sans', sans-serif;
            background-color: #FDFDFC;
            color: #1b1b18;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            width: 100%;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 0 1px rgba(26,26,0,0.16);
            padding: 30px;
        }
        h1 {
            margin-bottom: 20px;
            font-weight: 500;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
        }
        select, input {
            width: 100%;
            padding: 10px;
            border: 1px solid #e3e3e0;
            border-radius: 4px;
            font-family: inherit;
            font-size: 16px;
        }
        button {
            background-color: #1b1b18;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-family: inherit;
            font-size: 16px;
            font-weight: 500;
        }
        button:hover {
            background-color: #333;
        }
        .shape-params {
            display: none;
        }
        .shape-params.active {
            display: block;
        }
        #result {
            margin-top: 30px;
            padding: 20px;
            background-color: #f8f8f8;
            border-radius: 4px;
            border: 1px solid #e3e3e0;
            display: none;
        }
        #result.active {
            display: block;
        }
        .result-title {
            font-weight: 500;
            margin-bottom: 10px;
        }
        .result-value {
            font-size: 24px;
            font-weight: 600;
        }
        .loading {
            display: inline-block;
            margin-left: 10px;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Shape Area Calculator</h1>
        <form id="shapeForm" action="{{ route('shape.calculate') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="shape">Select Shape:</label>
                <select id="shape" name="type" required>
                    <option value="">-- Select Shape --</option>
                    <option value="square">Square</option>
                    <option value="circle">Circle</option>
                    <option value="triangle">Triangle</option>
                    <option value="trapezoid">Trapezoid</option>
                    <option value="parallelogram">Parallelogram</option>
                </select>
            </div>

            <div id="squareParams" class="shape-params">
                <div class="form-group">
                    <label for="width">Width:</label>
                    <input type="number" id="width" name="width" step="0.01" min="0" placeholder="Enter width">
                </div>
                <div class="form-group">
                    <label for="height">Height:</label>
                    <input type="number" id="height" name="height" step="0.01" min="0" placeholder="Enter height">
                </div>
            </div>

            <div id="circleParams" class="shape-params">
                <div class="form-group">
                    <label for="radius">Radius:</label>
                    <input type="number" id="radius" name="radius" step="0.01" min="0" placeholder="Enter radius">
                </div>
            </div>

            <div id="triangleParams" class="shape-params">
                <div class="form-group">
                    <label for="triangleBase">Base:</label>
                    <input type="number" id="triangleBase" name="base" step="0.01" min="0" placeholder="Enter base">
                </div>
                <div class="form-group">
                    <label for="triangleHeight">Height:</label>
                    <input type="number" id="triangleHeight" name="height" step="0.01" min="0" placeholder="Enter height">
                </div>
            </div>

            <div id="trapezoidParams" class="shape-params">
                <div class="form-group">
                    <label for="topBase">Top Base:</label>
                    <input type="number" id="topBase" name="top_base" step="0.01" min="0" placeholder="Enter top base">
                </div>
                <div class="form-group">
                    <label for="bottomBase">Bottom Base:</label>
                    <input type="number" id="bottomBase" name="bottom_base" step="0.01" min="0" placeholder="Enter bottom base">
                </div>
                <div class="form-group">
                    <label for="trapezoidHeight">Height:</label>
                    <input type="number" id="trapezoidHeight" name="height" step="0.01" min="0" placeholder="Enter height">
                </div>
            </div>

            <div id="parallelogramParams" class="shape-params">
                <div class="form-group">
                    <label for="parallelogramBase">Base:</label>
                    <input type="number" id="parallelogramBase" name="base" step="0.01" min="0" placeholder="Enter base">
                </div>
                <div class="form-group">
                    <label for="parallelogramHeight">Height:</label>
                    <input type="number" id="parallelogramHeight" name="height" step="0.01" min="0" placeholder="Enter height">
                </div>
            </div>

            <button type="submit" id="calculateBtn">Calculate Area</button>
        </form>

        <div id="result">
            <div class="result-title">Area:</div>
            <div class="result-value" id="areaResult"></div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const shapeSelect = document.getElementById('shape');
            const squareParams = document.getElementById('squareParams');
            const circleParams = document.getElementById('circleParams');
            const triangleParams = document.getElementById('triangleParams');
            const trapezoidParams = document.getElementById('trapezoidParams');
            const parallelogramParams = document.getElementById('parallelogramParams');
            const resultDiv = document.getElementById('result');
            const areaResult = document.getElementById('areaResult');
            const form = document.getElementById('shapeForm');
            const calculateBtn = document.getElementById('calculateBtn');

            shapeSelect.addEventListener('change', function() {
                // Hide all parameter sections
                squareParams.classList.remove('active');
                circleParams.classList.remove('active');
                triangleParams.classList.remove('active');
                trapezoidParams.classList.remove('active');
                parallelogramParams.classList.remove('active');

                // Show the selected shape's parameters
                if (this.value === 'square') {
                    squareParams.classList.add('active');
                } else if (this.value === 'circle') {
                    circleParams.classList.add('active');
                } else if (this.value === 'triangle') {
                    triangleParams.classList.add('active');
                } else if (this.value === 'trapezoid') {
                    trapezoidParams.classList.add('active');
                } else if (this.value === 'parallelogram') {
                    parallelogramParams.classList.add('active');
                }

                // Hide result when shape changes
                resultDiv.classList.remove('active');
            });

            // Form submission with AJAX
            form.addEventListener('submit', function(e) {
                e.preventDefault(); // Prevent default form submission

                const selectedShape = shapeSelect.value;
                let isValid = true;

                // Validate form
                if (selectedShape === 'square') {
                    const width = document.getElementById('width').value;
                    const height = document.getElementById('height').value;

                    if (!width || !height) {
                        alert('Please enter both width and height for the square.');
                        isValid = false;
                    }
                } else if (selectedShape === 'circle') {
                    const radius = document.getElementById('radius').value;

                    if (!radius) {
                        alert('Please enter the radius for the circle.');
                        isValid = false;
                    }
                } else if (selectedShape === 'triangle') {
                    const base = document.getElementById('triangleBase').value;
                    const height = document.getElementById('triangleHeight').value;

                    if (!base || !height) {
                        alert('Please enter both base and height for the triangle.');
                        isValid = false;
                    }
                } else if (selectedShape === 'trapezoid') {
                    const topBase = document.getElementById('topBase').value;
                    const bottomBase = document.getElementById('bottomBase').value;
                    const height = document.getElementById('trapezoidHeight').value;

                    if (!topBase || !bottomBase || !height) {
                        alert('Please enter top base, bottom base, and height for the trapezoid.');
                        isValid = false;
                    }
                } else if (selectedShape === 'parallelogram') {
                    const base = document.getElementById('parallelogramBase').value;
                    const height = document.getElementById('parallelogramHeight').value;

                    if (!base || !height) {
                        alert('Please enter both base and height for the parallelogram.');
                        isValid = false;
                    }
                }

                if (isValid) {
                    // Show loading state
                    calculateBtn.innerHTML = 'Calculating... <span class="loading">⟳</span>';
                    calculateBtn.disabled = true;

                    // Create a new FormData object
                    const formData = new FormData();

                    // Add the CSRF token
                    formData.append('_token', document.querySelector('input[name="_token"]').value);

                    // Add the shape type
                    formData.append('type', selectedShape);

                    // Add only the parameters for the selected shape
                    if (selectedShape === 'square') {
                        formData.append('width', document.getElementById('width').value);
                        formData.append('height', document.getElementById('height').value);
                    } else if (selectedShape === 'circle') {
                        formData.append('radius', document.getElementById('radius').value);
                    } else if (selectedShape === 'triangle') {
                        formData.append('base', document.getElementById('triangleBase').value);
                        formData.append('height', document.getElementById('triangleHeight').value);
                    } else if (selectedShape === 'trapezoid') {
                        formData.append('top_base', document.getElementById('topBase').value);
                        formData.append('bottom_base', document.getElementById('bottomBase').value);
                        formData.append('height', document.getElementById('trapezoidHeight').value);
                    } else if (selectedShape === 'parallelogram') {
                        formData.append('base', document.getElementById('parallelogramBase').value);
                        formData.append('height', document.getElementById('parallelogramHeight').value);
                    }

                    // Send AJAX request
                    fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Display result
                        areaResult.textContent = data.area.toFixed(2);
                        resultDiv.classList.add('active');

                        // Reset button state
                        calculateBtn.innerHTML = 'Calculate Area';
                        calculateBtn.disabled = false;
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while calculating the area.');

                        // Reset button state
                        calculateBtn.innerHTML = 'Calculate Area';
                        calculateBtn.disabled = false;
                    });
                }
            });
        });
    </script>
</body>
</html>
