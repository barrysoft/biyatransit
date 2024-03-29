<?php

namespace App\Http\Controllers;


use App\Models\Folder;
use App\Models\Setting;
use Money\Currency;
use Money\Money;
use Money\Currencies\ISOCurrencies;
use Money\Formatter\IntlMoneyFormatter;

class PrintController extends Controller
{
    public function generateInvoice(Folder $folder)
    {
        $folder->load('customer.user', 'containers', 'invoice.amounts.service')
            ->loadCount('containers');
        $containers = $folder->containers;
        $invoice = $folder->invoice;
        $invoice->loadSum('amounts', 'amount');
        $amounts = $invoice->amounts;

        $total = new Money($invoice->amounts_sum_amount, new Currency('GNF'));
        $currencies = new ISOCurrencies();
        $numberFormatter = new \NumberFormatter('fr_FR', \NumberFormatter::SPELLOUT);
        $moneyFormatter = new IntlMoneyFormatter($numberFormatter, $currencies);
        $totalInText = $moneyFormatter->format($total);
        $setting = Setting::query()->find(1);

        return view('invoices.printer', compact('setting', 'folder', 'containers', 'invoice', 'amounts', 'totalInText'));
    }
}
