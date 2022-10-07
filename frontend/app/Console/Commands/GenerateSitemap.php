<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Helpers\ApiH;
use Spatie\Sitemap\SitemapGenerator;
use Carbon\Carbon;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:sitemap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Pita Situs.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            echo Carbon::now().PHP_EOL;
            $sitemap = Sitemap::create();
            
            $sitemap->add(Url::create('/')
            ->setLastModificationDate(Carbon::now())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
            ->setPriority(0.1));
            // $res = ApiH::apiGetVar('/st/posts');
            // if (isset($res->data)) {
            //     echo '1';
            //     foreach ($res->data as $key) {
            //         $updated_at = Carbon::createFromFormat('Y-m-d H:i:s', $key->updated_at, 'UTC')
            //         ->setTimezone('Asia/Jakarta');
            //         $sitemap->add(Url::create('/c/'. $key->fncategory .'/'. $key->ftuniq .'/'.$key->fttitle_url)
            //         ->setLastModificationDate(Carbon::parse($updated_at))
            //         ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
            //         ->setPriority(0.2));
            //         echo '2';
            //     }
            //     echo '3';
            // }
            $sitemap->writeToFile(public_path('posts.xml'));
            echo public_path('sm/posts.xml');

        } catch (\Exception $e) {
            echo $e->getMessage().PHP_EOL;
        }
    }
}
