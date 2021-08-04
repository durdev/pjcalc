<?php

namespace App\Console\Commands;

use App\Http\Requests\BillRequest;
use App\Models\Bill;
use App\Models\Expense;
use Illuminate\Console\Command;

class ExpensesCreator extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pjcalc:create-expenses {--month} {--week}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command that create the expenses by recurrence';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        public Bill $bill,
        public Expense $expense
    ) {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $bills = collect([]);

        if ($this->option('month')) {
            $bills = $bills->concat($this->bill->filterByRecurrence(Bill::MONTHLY));
        }

        if ($this->option('week')) {
            $bills = $bills->concat($this->bill->filterByRecurrence(Bill::WEEKLY));
        }

        foreach($bills as $bill) {
            $expense              = new Expense();
            $expense->name        = $bill->name;
            $expense->value       = $bill->value;
            $expense->category_id = $bill->category_id;
            $expense->save();
        }

        return 0;
    }

}
