@section('title', 'Home')
@include('template/header')
<div class="main bg">
    <div class="text-center">
        <h1>Pay</h1>
    </div>
    <div class="container d-flex justify-content-center">
<a id="btn-pay" class="btn btn-primary" style="display: none;" href="{{ $link }}">Pay ({{ $sum }} USD)</a>

<div id="offerta">
            Public Offer

<p><a href="https://www.milliontiktokershomepage.com" target="_blank">https://www.milliontiktokershomepage.com</a> is a website where ads are placed under the domain name. Hereinafter referred to as the “Seller”, it announces a Public Offer for the Sale of Goods at a Distance.</p>

<p>1. DEFINITION OF TERMS</p>

<p>1.1. Public offer (hereinafter referred to as "Offer") - an offer to sell 1 million pixels available remotely through the seller's website.</p>
<p>1.2. The buyer is required to pay $ 1 per pixel for the number of pixels specified.</p>
<p>2. GENERAL RULES</p>
<p>2.1 The Buyer agrees to all the terms of the offer by selecting a pixel or a set of pixels.</p>
<p>2.2 Once a GIF is uploaded, it cannot be modified and will remain on the website forever.</p>
<p>2.3 The buyer can upload a file in GIF format up to a maximum of 0.3 megabytes.</p>
<p>2.4 The seller guarantees that the buyer's GIF file will remain on the website forever.</p>

<p>3. PRICE OF GOODS</p>
<p>3.1 The website has 1 million pixels. 1 Pixel costs $ 1.</p>
<p>3.2 Depending on the number of pixels, its price also varies.</p>
<p>3.3 The buyer's obligation to pay is considered to be fulfilled when the money is transferred to the bank account.</p>

<p>4 BUYER’S OBLIGATION</p>
<p>4.1 Not eligible to sell purchased set of pixels.</p>
<p>4.2 Does not have the right to change the placed GIF.</p>

<p>5 SELLER’S OBLIGATION</p>
<p>5.1 Obliged to place and control pixels in accordance with the amount paid.</p>
<p>5.2 The Seller must rectify the problem if the Buyer contacts a problem that occurs on the website.</p>

<button class="btn btn-dark" onclick="showBtnPay()">Okay</button>



<script>
    function showBtnPay() {
        $('#offerta').css('display', 'none');
        $('#btn-pay').css('display', 'block');
        $("html, body").scrollTop(0);
    }
</script>
</div>
</div>
</div>
@include('template/footer')
