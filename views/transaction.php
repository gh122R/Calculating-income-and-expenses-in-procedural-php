<!DOCTYPE html>
<html>
<head>
    <title>Transactions</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }

        table tr th, table tr td {
            padding: 5px;
            border: 1px #eee solid;
        }

        tfoot tr th, tfoot tr td {
            font-size: 20px;
        }

        tfoot tr th {
            text-align: right;
        }
    </style>
</head>
<body>
<table>
    <thead>
    <tr>
        <th>Дата</th>
        <th>Чек</th>
        <th>Описание</th>
        <th>Сумма</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if (! empty($transactions)): ?>
        <?php foreach ($transactions as $transaction): ?>
            <tr>
                <td><?= formatDate($transaction['date']) ?></td>
                <td><?= $transaction['checkNumber'] ?></td>
                <td><?= $transaction['description'] ?></td>
                <td>
                    <?php if ($transaction['amount'] < 0): ?>
                    <span style="background-color: red"> <?= formatAmount($transaction['amount']) ?></span>
                    <?php elseif ($transaction['amount'] > 0): ?>
                    <span style="color: green"> <?= formatAmount($transaction['amount']) ?></span>
                    <?php else: ?>
                    <?= formatAmount($transaction['amount'])  ?>
                    <?php endif ?>
                </td>
            </tr>
        <?php endforeach ?>
    <?php endif ?>
    </tbody>
    <tfoot>
    <tr>
        <th colspan="3">Доход:</th>
        <td><?= formatAmount($totals['totalIncome']) ?? 0 ?></td>
    </tr>
    <tr>
        <th colspan="3">Расходы:</th>
        <td><?= formatAmount($totals['totalExpense']) ?? 0 ?></td>
    </tr>
    <tr>
        <th colspan="3">Всего:</th>
        <td><?= formatAmount($totals['total']) ?? 0 ?></td>
    </tr>
    </tfoot>
</table>
</body>
</html>