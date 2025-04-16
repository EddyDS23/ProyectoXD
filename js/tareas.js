
const taskName = document.getElementById('taskName');
const taskDescription = document.getElementById('taskDescription');
const btnTaskSend = document.getElementById('btnTaskSend');
const taskList = document.getElementById('taskList');

getTask();

btnTaskSend.addEventListener("click",function(){
    data = {
        name: taskName.value,
        description: taskDescription.value
    }
    


    fetch('../php/tareas.php',{
        method: 'POST',
        headers:{
            "Content-Type":"application/json"
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(result => {
        console.log("Tarea registrada ",result)
        getTask();
        taskName.value = '';
        taskDescription.value  = '';
    })
    .catch(error => {
        console.log("Tarea error: ",error)
    })
})


function getTask(){
    fetch('../php/tareas.php',{
        method:'GET'
    })
    .then(response => response.json())
    .then(result => {
        if(result.status === 'success'){
            taskList.innerHTML = '';
            result.tasks.forEach(task => {
                const div = document.createElement('div');
                div.className = 'task';
                div.innerHTML = `
                    <h3>${task.tas_name}</h3>
                    <p>${task.tas_description}</p>
                    <small>${task.tas_status}</small>
                `
                if(task.tas_status === 'progress'){
                    const btnTaskSuccess = document.createElement('button');
                    btnTaskSuccess.textContent = 'Terminar';
                    btnTaskSuccess.addEventListener("click",function(){
                        console.log("btnSuccess working");    
                    })
                    div.appendChild(btnTaskSuccess);
                };

                taskList.appendChild(div);
            })
        }else{
            taskList.innerHTML = `<p>No hay tareas disponibles</p>`;
        }
    })
    .catch(error => {
        console.log("Error: ",error);
    });
}


function updateStatusTask(taskId){

    data = {
        taskId:taskId
    }

    fetch('../php/tareas.php',{
        method:'PUT',

    })


}



