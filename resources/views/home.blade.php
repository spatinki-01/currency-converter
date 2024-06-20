<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Currency Converter</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <div class="container">
        <h1>Currency Converter</h1>

        @if($errors->any())
            <div class="error-message">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('error'))
            <p class="error-message">{{ session('error') }}</p>
        @endif

        <form method="post" action="{{ route('getAmount.post') }}">
            @csrf
            <label for="amount">Amount:</label>
            <input type="number" name="amount" id="amount" value="{{ old('amount', session('amount')) }}" required>

            <label for="fromCurrency">From Currency:</label>
            <select name="fromCurrency" id="fromCurrency" required onChange="this.form.submit();">
                @foreach($currencyData as $currency)
                    <option value="{{ $currency['code'] }}" {{ session('fromCurrency') == $currency['code'] ? 'selected' : '' }}>
                        {{ $currency['name'] }} ({{ $currency['symbol'] }})
                    </option>
                @endforeach
            </select>

            <label for="toCurrency">To Currency:</label>
            <select name="toCurrency" id="toCurrency" required onChange="this.form.submit();">
                @foreach($currencyData as $currency)
                    <option value="{{ $currency['code'] }}" {{ session('toCurrency') == $currency['code'] ? 'selected' : '' }}>
                        {{ $currency['name'] }} ({{ $currency['symbol'] }})
                    </option>
                @endforeach
            </select>

            <button type="submit">Convert</button>
        </form>

        @if(session('convertedAmount'))
            <h2 class="result">Converted Amount: {{ session('convertedAmount') }} {{ session('toCurrency') }}</h2>
        @endif
    </div>
</body>
</html>
