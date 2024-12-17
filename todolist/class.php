<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\UI\Extension;
use Bitrix\Main\Engine\Contract\Controllerable;


Extension::load("ui.vue3");
class TodoList extends CBitrixComponent implements Controllerable
{
    public $todos = [];

    protected $entityId = 2;
    protected $entityCode = 'Todolist';

    protected function getDataClass()
    {
        \Bitrix\Main\Loader::includeModule("highloadblock");

        $entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($this->entityCode);
        return $entity->getDataClass();
    }

    public function getList($arParams)
    {
        $className = $this->getDataClass();
        $result = $className::getList($arParams);
        $arItems = array();
        while ($arItem = $result->fetch()) {
            $arItems[] = $arItem;
        }
        return $arItems;
    }

    public function configureActions(): array
    {
        return [];
    }

    public function deleteTodoAction($id): array
    {
        $className = $this->getDataClass();
        $className::delete($id);
        return self::getTodosAction();
    }

    public function getTodosAction(): array
    {
        $arParams = [
            'filter' => [],
            'order' => [],
            'select' => ['*'],
        ];

        $this->todos = $this->getList($arParams);

        return $this->todos;
    }

    public function addTodoAction(): array
    {
        $arParams = [
            'UF_DATA' => $_POST['name'],
        ];
        $className = $this->getDataClass();
        $className::add($arParams);

        return self::getTodosAction();
    }

    public function executeComponent(): void
    {
        $this->includeComponentTemplate();
    }
}