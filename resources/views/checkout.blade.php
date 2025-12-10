<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stripe Checkout</title>

    <!-- Bootstrap for styling -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Stripe.js -->
    <script src="https://js.stripe.com/v3/"></script>

    <style>
        body {
            background: #f8f9fa;
        }
        .card {
            margin-top: 40px;
            border-radius: 12px;
        }
        .StripeElement {
            padding: 12px;
            background: white;
            border-radius: 6px;
            border: 1px solid #ced4da;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">

            @if(session('success'))
                <div class="alert alert-success mt-3">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger mt-3">
                    {{ session('error') }}
                </div>
            @endif

            <div class="card p-4 shadow">
                <h3 class="text-center mb-3">Make a Payment</h3>

                <form id="payment-form" action="{{ route('payment.process') }}" method="POST">
                    @csrf

                    <!-- Email -->
                    <div class="mb-3">
                        <label>Email (Optional)</label>
                        <input type="email" name="email" class="form-control" placeholder="example@email.com">
                    </div>

                    <!-- Amount -->
                    <div class="mb-3">
                        <label>Amount (USD)</label>
                        <input type="number" name="amount" class="form-control" required>
                    </div>

                    <!-- Stripe Card Element -->
                    <div class="mb-3">
                        <label>Card Details</label>
                        <div id="card-element" class="StripeElement"></div>
                    </div>

                    <input type="hidden" name="stripeToken" id="stripeToken">

                    <button id="submitBtn" class="btn btn-primary w-100">Pay Now</button>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
    const stripe = Stripe("{{ env('STRIPE_KEY') }}");
    const elements = stripe.elements();

    const cardElement = elements.create("card");
    cardElement.mount("#card-element");

    const form = document.getElementById("payment-form");

    form.addEventListener("submit", async function (event) {
        event.preventDefault();

        document.getElementById("submitBtn").disabled = true;

        const { token, error } = await stripe.createToken(cardElement);

        if (error) {
            alert(error.message);
            document.getElementById("submitBtn").disabled = false;
        } else {
            document.getElementById("stripeToken").value = token.id;
            form.submit();
        }
    });
</script>

</body>
</html>
