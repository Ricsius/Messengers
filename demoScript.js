const easyTask = [
    [0, 0, 0, 2, 0],
    [0, 1, 0, 0, 0],
    [0, 0, 2, 0, 0],
    [3, 0, 0, 3, 0],
    [1, 0, 0, 0, 0]
];

const mediumTask = [
    [2 , 0 , 0 , 9 , 0 , 0 , 0 , 5 , 0],
    [1 , 0 , 0 , 8 , 0 , 11, 0 , 0 , 5],
    [0 , 2 , 0 , 0 , 6 , 0 , 7 , 0 , 0],
    [0 , 0 , 0 , 0 , 0 , 11, 0 , 10, 0],
    [0 , 0 , 0 , 7 , 0 , 0 , 0 , 0 , 0],
    [0 , 0 , 0 , 4 , 0 , 0 , 0 , 0 , 0],
    [0 , 0 , 0 , 0 , 0 , 0 , 0 , 3 , 6],
    [0 , 9 , 0 , 4 , 8 , 0 , 0 , 0 , 0],
    [0 , 1 , 0 , 0 , 0 , 0 , 0 , 10, 3]
];

const hardTask = [
    [1, 0, 0, 0, 3, 0, 5, 0, 2],
    [0, 0, 0, 0, 0, 0, 8, 5, 0],
    [7, 4, 0, 6, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 1, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 2],
    [0, 0, 4, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 7, 0, 0, 0, 0, 3, 0, 0],
    [0, 0, 0, 6, 0, 0, 0, 0, 8]
];

const tasks = [easyTask, mediumTask, hardTask];
const colors = ["red", "green", "blue", "yellow", "orange", 
                "navy", "pink", "purple", "teal", "cyan", "gray"];
const decriptionDiv = document.querySelector("#decriptionDiv");
const gameDiv = document.querySelector("#gameDiv");
const elteMsg = document.querySelector("#elteMsg");
const msg0 = document.querySelector("#msg0");
const taskSelect = document.querySelector("#taskSelect");
const taskLoaderButton = document.querySelector("#taskLoaderButton");
const gameTable = document.querySelector("#gameTable");
const loadGameButton = document.createElement("input");
const saveGameButton = document.createElement("input");
const backToTaskSelectionButton = document.createElement("input");
const msg1 = document.createElement("span");

let selectedTask;
let selectedTaskIndex;
let cells;
let lines;
let lineStarterCells;
let cellsBelongingToCompleteLines;
let currentLineIndex;
let currentTaskSavedState;

taskLoaderButton.addEventListener("click", selectTask);

saveGameButton.type = "button";
saveGameButton.value = "Save game";
saveGameButton.addEventListener("click", saveSelectedTaskState);

loadGameButton.type = "button";
loadGameButton.value = "Load saved state";
loadGameButton.addEventListener("click", loadSelectedTaskSave);

backToTaskSelectionButton.type = "button";
backToTaskSelectionButton.value = "Back to task selection";
backToTaskSelectionButton.addEventListener("click", backToTaskSelection);

function selectTask(e){
    //console.log("I started a new game.");

    decriptionDiv.remove();
    elteMsg.remove();
    msg0.remove();
    taskSelect.remove();
    taskLoaderButton.remove();

    selectedTask = tasks[taskSelect.value];
    selectedTaskIndex = taskSelect.value;

    initializeGame(selectedTask);
}

function initializeGame(task){
    cells = [];
    lines = [];
    lineStarterCells = [];
    cellsBelongingToCompleteLines = [];
    currentLineIndex = -1;

    gameTable.innerHTML = "";
    gameTable.style.visibility = "visible";

    for(let i = 0; i < task.length; ++i){
        let row = gameTable.insertRow(i);

        for(let j = 0; j < task[i].length; ++j){
            let cell = row.insertCell(j);

            cell.id = i + "," + j;

            if(parseInt(task[i][j]) != 0){
                while(lines.length < parseInt(task[i][j])){
                    lines.push([]);
                    lineStarterCells.push([]);
                }

                lineStarterCells[parseInt(task[i][j]) - 1].push(cell);
                cell.innerText = task[i][j];
                cell.addEventListener("mousedown", startLine);
            }

            cellsBelongingToCompleteLines.push(false);
            cells.push(cell);
        }
    }

    gameDiv.append(saveGameButton);
    gameDiv.append(loadGameButton);
    gameDiv.append(msg1);

    currentTaskSavedState = localStorage.getItem("savedState" + selectedTaskIndex);

    if(currentTaskSavedState == null){
        loadGameButton.disabled = true;
    }
    else{
        loadGameButton.disabled = false;
        msg1.innerHTML = "<br>You already have a saved state on this task. If you click the " +
         saveGameButton.value + " button the previous save will be overwritten.";
    }
}

function startLine(e){
    e.preventDefault();
    currentLineIndex = (e.target.innerText) - 1;
    lines[currentLineIndex].push(e.target);
    e.target.style.backgroundColor = colors[currentLineIndex];
    e.target.addEventListener("mouseenter", tryRemoveLastCellFromCurrentLine);

    for(let i = 0; i < cells.length; ++i){
        if(!cellsBelongingToCompleteLines[i] && cells[i] != e.target){
            cells[i].addEventListener("mouseenter", tryAddToCurrentLine);
        }
    }

    document.addEventListener("mouseup", finishCurrentLine);
    //console.log("I started line " + (currentLineIndex+1));
}

function tryAddToCurrentLine(e){
    let currentLineArray = lines[currentLineIndex];
    let pos = e.target.id.split(',');
    let lastpos = currentLineArray[currentLineArray.length - 1].id.split(',');
    let ri = parseInt(pos[0]);
    let ci = parseInt(pos[1]);
    let lastRi = parseInt(lastpos[0]);
    let lastCi = parseInt(lastpos[1]);
    let b1 = (ri == lastRi) && (Math.abs(ci - lastCi) == 1);
    let b2 = (ci == lastCi) && (Math.abs(ri - lastRi) == 1);

    let isNinetyDegreeNeighbour = b1 || b2;
    let isNotPartOfACompleteLine = !cellsBelongingToCompleteLines[(ri * selectedTask[ri].length) + ci];
    let isAppropriateForCurrentLine = (e.target.innerText.length == 0) || (e.target.innerText == currentLineIndex + 1);
    
    if(isNinetyDegreeNeighbour &&
        isNotPartOfACompleteLine &&
        isAppropriateForCurrentLine){
        //console.log("I added (Ri: " + ri + " Ci: " + ci + ") to line " + (currentLineIndex+1));

        currentLineArray.push(e.target);
        e.target.style.backgroundColor = colors[currentLineIndex];
        e.target.removeEventListener("mouseenter", tryAddToCurrentLine);
        e.target.addEventListener("mouseenter", tryRemoveLastCellFromCurrentLine);
    }
}

function finishCurrentLine(e){
    //console.log("I finished line " + (currentLineIndex+1));

    let currentLineArray = lines[currentLineIndex];
    let isCompleteLine = currentLineArray[0]!= currentLineArray[currentLineArray.length - 1] &&
        currentLineArray[currentLineArray.length - 1].innerText == currentLineIndex + 1;

    for(let i = 0; i < cells.length; ++i){
        if(!cellsBelongingToCompleteLines[i]){
            cells[i].removeEventListener("mouseenter", tryAddToCurrentLine);
        }
    }

    currentLineArray.forEach(c => {
        c.removeEventListener("mouseenter", tryRemoveLastCellFromCurrentLine);
        });

    if(isCompleteLine){
        //console.log("The line was complete.");
    
        currentLineArray[0].removeEventListener("mousedown", startLine);
        currentLineArray[currentLineArray.length-1].removeEventListener("mousedown", startLine);

        currentLineArray.forEach(c => {
            let pos = c.id.split(',');
            let ri = parseInt(pos[0]);
            let ci = parseInt(pos[1]);

            cellsBelongingToCompleteLines[(ri * selectedTask[ri].length) + ci] = true;
            c.addEventListener('contextmenu', eraseCompleteLine);
        });

        if(checkWinCondition()){
            //console.log("Victory!!");
            victory();
        }
    }
    else{
        //console.log("The line was not complete.");

        
        while(currentLineArray.length > 0){
            let c =currentLineArray.pop();
            c.style.backgroundColor = gameTable.parentNode.style.backgroundColor;
        }
    }

    currentLineIndex = -1;
    document.removeEventListener("mouseup", finishCurrentLine);
}

function tryRemoveLastCellFromCurrentLine(e){
    let currentLineArray = lines[currentLineIndex];

    if(e.target != currentLineArray[currentLineArray.length - 2]){
        return;
    }

    let c = currentLineArray.pop();
    /*
    let pos = c.id.split(',');
    let ri = pos[0];
    let ci = pos[1];

    console.log("I removed (Ri: " + ri + " Ci: " + ci + ") from line " + (currentLineIndex+1));
    */
    c.style.backgroundColor = gameTable.parentNode.style.backgroundColor;
    c.removeEventListener("mouseenter", tryRemoveLastCellFromCurrentLine);
    c.addEventListener("mouseenter", tryAddToCurrentLine);
}

function checkWinCondition(){
    let sum = 0;

    lines.forEach(l => {
        sum += l.length;
    });

    return sum == cells.length;
}

function eraseCompleteLine(e){
    e.preventDefault();

    let color = e.target.style.backgroundColor;
    let i = 0;

    while(colors[i] != color){
        ++i;
    }

    lineStarterCells[i].forEach(c => {
        c.addEventListener("mousedown", startLine);
    });

    lines[i].forEach(c => {
        let pos = c.id.split(',');
        let ri = parseInt(pos[0]);
        let ci = parseInt(pos[1]);

        cellsBelongingToCompleteLines[(ri * selectedTask[ri].length) + ci] = false;
        c.style.backgroundColor = gameTable.parentNode.style.backgroundColor;
        c.removeEventListener('contextmenu', eraseCompleteLine);
    });

    lines[i] = [];

    //console.log("I erased complete line " + (i+1));
}

function saveSelectedTaskState(e){
    //console.log("I saved the game.");
    let savedState = generateSavedStateArray();
    let completeLines = [];

    for(let i = 0; i < lines.length; ++i){
        if(lines[i].length > 0){
            completeLines.push(i+1);
        }
    }

    let obj = {
        "completeLines" : completeLines,
        "savedState"    : savedState
    };

    localStorage.setItem("savedState" + selectedTaskIndex, JSON.stringify(obj));
    loadGameButton.disabled = false;
    msg1.innerHTML = "<br>Your state has been saved.";
    
}

function generateSavedStateArray(){
    let save = [];

    for(let i = 0; i < selectedTask.length; ++i){
        let row = [];
        for(let j = 0; j < selectedTask[i].length; ++j){
            row.push(selectedTask[i][j]);
        }

        save.push(row);
    }

    for(let i = 0; i < lines.length; ++i){
        lines[i].forEach(c => {
            let pos = c.id.split(',');
            let ri = parseInt(pos[0]);
            let ci = parseInt(pos[1]);

            save[ri][ci] = (i+1);
        });
    }

    return save;
}

function loadSelectedTaskSave(e){
    //console.log("I loaded a save.");

    saveGameButton.remove();
    loadGameButton.remove();

    initializeGame(selectedTask);

    let obj = JSON.parse(localStorage.getItem("savedState" + selectedTaskIndex));

    for(let i = 0; i < obj.savedState.length; ++i){
        for(let j = 0; j < obj.savedState[i].length; ++j){
            if(obj.savedState[i][j] != 0){
                let k = 0;
                while(k < obj.completeLines.length && obj.completeLines[k] != obj.savedState[i][j]){
                    ++k;
                }

                if(k < obj.completeLines.length){
                    let cellIndex = (i * selectedTask[i].length) + j;
                    let lineIndex = obj.completeLines[k] - 1;
                    let cell = cells[cellIndex];

                    lines[lineIndex].push(cell);
                    cellsBelongingToCompleteLines[cellIndex] = true;

                    cell.style.backgroundColor = colors[lineIndex];
                    cell.removeEventListener("mousedown", startLine);
                    cell.addEventListener("contextmenu", eraseCompleteLine);
                }
            }
        }
    }

    msg1.innerHTML = "<br>Your previous saved state has been loaded.";
}

function victory(){
    msg1.innerHTML = "Congratulations, you completed the task! <br>Click the button bellow to select another task.<br>"
    saveGameButton.remove();
    loadGameButton.remove();

    gameDiv.append(backToTaskSelectionButton);
    
    cells.forEach(c => {
        c.removeEventListener("contextmenu", eraseCompleteLine);
    });
}

function backToTaskSelection(e){
    gameTable.remove();
    msg1.remove();
    backToTaskSelectionButton.remove();

    gameDiv.append(decriptionDiv);
    gameDiv.append(msg0);
    gameDiv.append(taskSelect);
    gameDiv.append(taskLoaderButton);
    gameDiv.append(elteMsg);

    gameDiv.append(gameTable);
    gameTable.style.visibility = "hidden";
}