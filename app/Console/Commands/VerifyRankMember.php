<?php

namespace App\Console\Commands;

use App\Http\Controllers\services\MemberController;
use App\Http\Controllers\services\RankController;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Http\Request;

class VerifyRankMember extends Command
{
    protected $memberController;
    protected $rankController;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'VerifyRankMember:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This is Cronjob check to rank of member';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->memberController = new MemberController();
        $this->rankController = new RankController();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        info("Start cronjob: " . Carbon::now('Asia/Ho_Chi_Minh'));
        $members = $this->memberController->getAllMember()['data'];
        foreach ($members as $member) {
            if ($member->rank_id == "BRONZE") {
                info($member->member_id . ": is rank Bronze");
            } else {
                $end_date =
                    Carbon::createFromFormat('Y-m-d', $member->date_end_rank);
                $now = Carbon::now('Asia/Ho_Chi_Minh');
                if ($now >= $end_date) {
                    $rank = $this->rankController->getPreviousRankOfCurrentRankAndStatus($member->rank_id, $member->rank->point, 1)['data'];
                    $this->memberController->updateRankMember(new Request([
                        'member_id' => $member->member_id,
                        'rank_id' => $rank->rank_id,
                        'current_point' => $rank->point
                    ]));
                    info($member->member_id . ": is updated rank");
                } else {
                    info($member->member_id . ": is not expired date");
                }
            }
        }
        info("End cronjob: "
            . Carbon::now('Asia/Ho_Chi_Minh'));
    }
}