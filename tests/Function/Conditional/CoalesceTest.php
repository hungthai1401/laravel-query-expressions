<?php

declare(strict_types=1);

use Illuminate\Database\Query\Expression;
use Tpetry\QueryExpressions\Function\Conditional\Coalesce;

it('can combine multiple columns')
    ->expect(new Coalesce(['val1', 'val2', 'val3']))
    ->toBeExecutable(['val1 int', 'val2 int', 'val3 int'])
    ->toBeMysql('coalesce(`val1`, `val2`, `val3`)')
    ->toBePgsql('coalesce("val1", "val2", "val3")')
    ->toBeSqlite('coalesce("val1", "val2", "val3")')
    ->toBeSqlsrv('coalesce([val1], [val2], [val3])');

it('can combine multiple expressions')
    ->expect(new Coalesce([new Expression(1), new Expression(2), new Expression(3)]))
    ->toBeExecutable()
    ->toBeMysql('coalesce(1, 2, 3)')
    ->toBePgsql('coalesce(1, 2, 3)')
    ->toBeSqlite('coalesce(1, 2, 3)')
    ->toBeSqlsrv('coalesce(1, 2, 3)');

it('can combine multiple columns and expressions')
    ->expect(new Coalesce(['val1', 'val2', new Expression(3)]))
    ->toBeExecutable(['val1 int', 'val2 int'])
    ->toBeMysql('coalesce(`val1`, `val2`, 3)')
    ->toBePgsql('coalesce("val1", "val2", 3)')
    ->toBeSqlite('coalesce("val1", "val2", 3)')
    ->toBeSqlsrv('coalesce([val1], [val2], 3)');
