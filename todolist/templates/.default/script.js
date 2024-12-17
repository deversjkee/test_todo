const { runComponentAction } = BX.ajax;
const { ref, createApp, reactive } = BX.Vue3;
BX.ready(() => {
    console.log('this');
    createApp({
        setup() {
            function deleteTodo(id) {
                const request = runComponentAction("dev:todolist", "deleteTodo", {
                    mode: "class",
                    data: { id: id },
                });
                request.then((reponse) => arResult.todos = reponse.data);
            }

            function addTodo(e) {
                e.preventDefault();
                const request = runComponentAction("dev:todolist", "addTodo", {
                    mode: "class",
                    data: new FormData(e.target),
                });
                request.then((reponse) => arResult.todos = reponse.data);
            }

            const arResult = reactive({});
            const request = runComponentAction("dev:todolist", "getTodos", {
                mode: "class",
            });
            request.then((reponse) => (arResult.todos = reponse.data));

            return {
                arResult,
                addTodo,
                deleteTodo,
            };
        },
    }).mount("#todo-list");
});