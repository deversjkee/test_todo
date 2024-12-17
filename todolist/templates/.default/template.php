<?php
/**
 * @var array $arResult
 * @var array $arParams
 *
 */
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$this->SetViewTarget('pagetitle');
$this->EndViewTarget();
\Bitrix\Main\UI\Extension::load("ui.vue3");
?>
<div id="app">
    <div class="main" id="todo-list">
        <div class="input">
            <form @submit="addTodo" class="form">
                <div class="form__field">
                    <label>Todo item</label>
                    <input type="text" name="name">
                </div>
                <button type="submit">Add new todo</button>
            </form>
        </div>
        <div class="todo-list">
            <ul class="todo-list">
                <li v-for="(todo, key) in arResult.todos" class="todos-list__item" :key="key">
                    {{ todo.UF_DATA }}
                    <button type="button" @click="deleteTodo(todo.ID)">Delete todo</button>
                </li>
            </ul>
        </div>
    </div>
</div>
