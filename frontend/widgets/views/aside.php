<div class="aside-box">
    <h3>Total orders the latest month</h3>
    <span class="orders-count"><?= $ordersCount; ?></span>
</div>

<div class="aside-box">
    <h3>Latest sign ups</h3>
    <?php
    // Show last CR/FF
    foreach ($companies as $item) {
        echo '<address>', $item['company_name'], '<br />', $item['zip'], ' ' , $item['city'], '</address>';
    }
    ?>
</div>

<div class="aside-box">
    <h3>Statement from a user</h3>
    <span class="users-statement">&quot;We usually use the same provider each time, but now using the ONTRIS we saved 15% on average on our transports, so it ;)&quot;</span>
    <em class="user-name">Svend Bent fra Grafisk Lys</em>
</div>