<?php

declare(strict_types=1);
function getTransactionFiles(string $dirPath):array
{
    $files = [];
    foreach (scandir($dirPath) as $file) {
        if(is_dir($file)){
            continue;
        }
        $files[] = $dirPath . $file;
    }
    return $files;
}

function getTransactions(string $fileName, ?callable $transactionHandler = null):array
{
    if (!file_exists($fileName)) {
        trigger_error('File' . $fileName . ' not found', E_USER_ERROR);
    }
    $file = fopen($fileName, "r");
    fgetcsv($file);
    $transactions = [];

    while(($transaction = fgetcsv($file)) !== false) {
        if ($transactionHandler !== null) {
            $transaction[] = $transactionHandler($transaction);
        }
        $transactions[] = extractTransaction($transaction);
    }
    return $transactions;
}

function extractTransaction(array $rowTransaction):array
{
    [$date,$checkNumber,$description,$amount] = $rowTransaction;
    $amount = (float) str_replace([',','$'],'',$amount);

    return[
        'date' => $date,
        'checkNumber' => $checkNumber,
        'description' => $description,
        'amount' => $amount,
    ];
}

function calculateTotals(array $transaction):array
{
    $totals = ['total' => 0, 'totalIncome' => 0, 'totalExpense' => 0];
    foreach ($transaction as $transaction) {
        $totals['total'] += $transaction['amount'];

        if($transaction['amount'] >= 0){
            $totals['totalIncome'] += $transaction['amount'];
        }else{
            $totals['totalExpense'] += $transaction['amount'];
        }
    }
    return $totals;
}