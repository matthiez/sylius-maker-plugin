<?php

namespace Ecolos\SyliusMakerPlugin\Grid\Filter;

use Sylius\Component\Grid\Data\DataSourceInterface;
use Sylius\Component\Grid\Filtering\FilterInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;

class MakerFilter implements FilterInterface
{
    private $makerRepository;

    public function __construct(RepositoryInterface $makerRepository) {
        $this->makerRepository = $makerRepository;
    }

    public function apply(DataSourceInterface $dataSource, $name, $data, array $options = []): void {
        if (isset($data['makers'])) {
            if (!is_array($data['makers'])) $data['makers'] = [$data['makers']];

            $makers = [];
            foreach ($data['makers'] as $maker) $makers[] = $maker;

            $dataSource->restrict(
                $dataSource->
                getExpressionBuilder()
                    ->in("maker", $makers)
            );
        }
    }
}
