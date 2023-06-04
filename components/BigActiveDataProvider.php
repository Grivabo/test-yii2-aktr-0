<?php
declare(strict_types = 1);

namespace app\components;

use yii\base\InvalidConfigException;
use yii\data\ActiveDataProvider;
use yii\db\QueryInterface;

/**
 *   Не совершает sql запрос "COUNT(*)". Запрашивает на один элемент больше и
 * так определяет есть ли следующая страница.
 *   При получении большого количества элементов из базы и использовании
 * пагинации запрос "COUNT(*)" может выполняться очень долго.
 */
class BigActiveDataProvider extends ActiveDataProvider
{
    /**
     * @inheritDoc
     */
    protected function prepareTotalCount(): int
    {
        return $this->getPagination()?->totalCount ?? 0;
    }

    /**
     * @inheritDoc
     * @throws InvalidConfigException
     */
    protected function prepareModels(): array
    {
        if (!$this->query instanceof QueryInterface) {
            throw new InvalidConfigException('The "query" property must be an instance of a class that implements the QueryInterface e.g. yii\db\Query or its subclasses.');
        }
        $query = clone $this->query;

        if (false !== $pagination = $this->getPagination()) {
            // Impossible validate without "COUNT(*)"
            $pagination->validatePage = false;

            $page = $pagination->getPage();
            $offset = $page * $pagination->getPageSize();
            $query->limit($pagination->getLimit() + 1)->offset($offset);
        }
        if (false !== $sort = $this->getSort()) {
            $query->addOrderBy($sort->getOrders());
        }

        $res = $query->all($this->db);

        if (false !== $pagination = $this->getPagination()) {

            /** @noinspection PhpUndefinedVariableInspection */
            $pagination->totalCount = $page * $pagination->getPageSize() + count($res);

            if (count($res) > $pagination->getPageSize()) {
                array_pop($res);
            }

            // If no result for current filter then go to the first page.
            if (0 === count($res) && $page > 0) {
                $pagination->page = 0;
                return $this->prepareModels();
            }
        }

        return $res;
    }
}