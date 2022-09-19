<?php

namespace Tests\Unit\Actions\Site\Province;

use App\Actions\Site\Province\DeleteProvince;
use App\Models\Site\Province;
use Mockery;
use PHPUnit\Framework\TestCase;

class DeleteProvinceTest extends TestCase
{
    public function tearDown(): void
    {
        Mockery::close();
    }

    public function testShouldDeleteProvince(): void
    {
        $mockProvince = Mockery::mock(Province::class)->makePartial();
        $mockProvince->shouldReceive('delete')->once()->andReturn(true);

        $deleteProvinceResult = DeleteProvince::run($mockProvince);

        $this->assertEquals($deleteProvinceResult, true);
    }
}
