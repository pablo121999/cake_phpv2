<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * DomainsFixture
 */
class DomainsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'domain' => 'Lorem ipsum dolor sit amet',
                'checked' => 1,
                'has_favicon' => 1,
                'path_favicon' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
