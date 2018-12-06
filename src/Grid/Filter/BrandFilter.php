<?php

namespace Ecolos\SyliusBrandPlugin\Grid\Filter;

use Sylius\Component\Grid\Data\DataSourceInterface;
use Sylius\Component\Grid\Filtering\FilterInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;

class BrandFilter implements FilterInterface
{
    private $brandRepository;

    public function __construct(RepositoryInterface $brandRepository) {
        $this->brandRepository = $brandRepository;
    }

    public function apply(DataSourceInterface $dataSource, $name, $data, array $options = []): void {
        if (isset($data['brands'])) {
            if (!is_array($data['brands'])) $data['brands'] = [$data['brands']];

            $brands = [];
            foreach ($data['brands'] as $brand)  $brands[] = $brand;

            // Your filtering logic. DataSource is kind of query builder. $data['stats'] contains the submitted value!
            $dataSource->restrict(
                $dataSource->
                getExpressionBuilder()
                    ->in("brand", $brands)
            );
        }
    }
}
