<?php
$riel = 2103942;
$kyat = 19092;
$krones = 109;
$lek = 9094;

echo "---- Starting Amounts ----\n";
echo "Riel: $riel\n";
echo "Kyat: $kyat\n";
echo "Krones: $krones\n";
echo "Lek: $lek\n";

// Exchange rates to USD
$riel_exchange_rate = 0.00025;
$kyat_exchange_rate = 0.000477;
$krones_exchange_rate = 0.094;
$lek_exchange_rate = 0.011;

// Ammounts in USD
$riel_in_USD = $riel * $riel_exchange_rate;
$kyat_in_USD = $kyat * $kyat_exchange_rate;
$krones_in_USD = $krones * $krones_exchange_rate;
$lek_in_USD = $lek * $lek_exchange_rate;

echo "---- Conversions to USD ----\n";
echo "Riel in USD: $" . number_format($riel_in_USD, 2) . "\n";
echo "Kyat in USD: $" . number_format($kyat_in_USD, 2) . "\n";
echo "Krones in USD: $" . number_format($krones_in_USD, 2) . "\n";
echo "Lek in USD: $" . number_format($lek_in_USD, 2) . "\n";
echo "-----------------------------\n";

// Currency exchange fee of $1 per conversion
$fee_per_conversion = 1;
$total_fees = 4 * $fee_per_conversion; // 4 conversions

// Total amount in USD after fees
$total_in_USD = ($riel_in_USD + $kyat_in_USD + $krones_in_USD + $lek_in_USD) - $total_fees;

echo "Total fees: $$total_fees\n";
echo "-----------------------------\n";
echo "Final amount in USD after fees: $" . number_format($total_in_USD, 2) . "\n";
echo "-----------------------------\n";