<?php 
ob_start(); // Start output buffering at the very top
require "../includes/header.php";
require "../config/config.php";

if(!isset($_SERVER['HTTP_REFERER'])){
    echo "<script>window.location.href='".APPURL."'</script>";
    exit;
}

// Check if price is set in session
if(!isset($_SESSION['price']) || empty($_SESSION['price'])) {
    header("Location: ".APPURL);
    exit;
}

// Sanitize the price
$price = htmlspecialchars($_SESSION['price']);
?>

<div class="cool-paypal-container">
    <div class="payment-card">
        <div class="payment-header">
            <div class="secure-checkout">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2L3 5V11C3 16.55 6.84 21.74 12 23C17.16 21.74 21 16.55 21 11V5L12 2ZM12 17C9.24 17 7 14.76 7 12C7 9.24 9.24 7 12 7C14.76 7 17 9.24 17 12C17 14.76 14.76 17 12 17Z" fill="#4CAF50"/>
                    <path d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z" fill="#4CAF50"/>
                </svg>
                <span>SECURE CHECKOUT</span>
            </div>
            <div class="payment-icons">
                <img src="https://www.paypalobjects.com/webstatic/mktg/logo/pp_cc_mark_37x23.jpg" alt="PayPal">
                <img src="https://www.paypalobjects.com/webstatic/mktg/logo-center/AM_mc_vs_dc_ae.jpg" alt="Credit Cards">
            </div>
        </div>

        <div class="amount-section">
            <div class="amount">$<?php echo number_format($price, 2); ?> USD</div>
        </div>

        <!-- PayPal button container -->
        <div id="paypal-button-container" class="paypal-button-wrapper"></div>
        
        <div class="payment-footer">
            <div class="guarantee">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2L4 5V11.09C4 16.14 7.41 20.85 12 22C16.59 20.85 20 16.14 20 11.09V5L12 2ZM10.94 15.54L7.4 12L8.81 10.59L10.93 12.71L15.17 8.47L16.58 9.88L10.94 15.54Z" fill="#2196F3"/>
                </svg>
                <span>Protected by PayPal</span>
            </div>
        </div>
    </div>
</div>

<script src="https://www.paypal.com/sdk/js?client-id=Adq6jsst0eepUfSy5Vvte-2y6w-FpL_GFsoMHXXuDp8B6Ce_xQB-JTeMZft6opM_fm4h44jicZS1RodX&currency=USD"></script>
<script>
    paypal.Buttons({
    createOrder: (data, actions) => {
        document.getElementById("loading-spinner").style.display = "block";
        return actions.order.create({
            purchase_units: [{
                amount: { value: '<?php echo $price; ?>' }
            }]
        });
    },
    onApprove: (data, actions) => {
        return actions.order.capture().then(function(orderData) {
            window.location.href='http://localhost:3000/hotel-booking/rooms/room-single.php';
        });
    },
    onError: (err) => {
        document.getElementById("loading-spinner").style.display = "none";
        alert("An error occurred. Please try again.");
    }
}).render('#paypal-button-container');

</script>

<style>
.cool-paypal-container {
    max-width: 380px;
    margin: 20px auto;
    font-family: 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', sans-serif;
}

.payment-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    border: 1px solid #e0e0e0;
}

.payment-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 14px 20px;
    background: #f8f9fa;
    border-bottom: 1px solid #eeeeee;
}

.secure-checkout {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    font-weight: 600;
    letter-spacing: 0.5px;
    color: #5f6368;
}

.payment-icons {
    display: flex;
    gap: 8px;
}

.payment-icons img {
    height: 22px;
    width: auto;
}

.amount-section {
    padding: 24px 20px 16px;
    text-align: center;
}

.amount {
    font-size: 28px;
    font-weight: 600;
    color: #202124;
}

.paypal-button-wrapper {
    padding: 0 20px 20px;
}

.payment-footer {
    padding: 12px 20px;
    background: #f8f9fa;
    border-top: 1px solid #eeeeee;
    text-align: center;
}

.guarantee {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    color: #5f6368;
}

/* Make PayPal button match our design */
.paypal-button-container {
    border-radius: 8px !important;
    height: 46px !important;
}

@media (max-width: 480px) {
    .cool-paypal-container {
        max-width: 100%;
        padding: 0 15px;
    }
    
    .payment-header {
        flex-direction: column;
        gap: 10px;
        align-items: flex-start;
    }
    
    .payment-icons {
        align-self: flex-end;
    }
}
</style>

<?php require "../includes/footer.php"; ?>