class TableHandler {
    constructor() {
        this.csrf = $('meta[name="csrf-token"]').attr('content');
        this.selectedCell = false;
        this.memory = [];
        this.loadedContent = 1;
    }

    getContent() {
        $.ajax({
            type: "GET",
            url: '/content',
            data: {"loaded": table.loadedContent},
            success: function(data) {
                table.handleLoadedContent(data);
            }
        });
    }

    handleLoadedContent(data) {
        if (data.length === 0) {
            return null;
        }
        for (let cell of data) {
            let id = String(cell.y + 'x' + cell.x);
            $('#' + id).html(cell.val);
            this.loadedContent++;
        }
        this.getContent();
    }

    selectCell(position) {
        if (this.selectedCell) {
            this.saveCellData();
            return null;
        }

        let tempPos = position.split('x');
        let y = tempPos[0];
        let x = tempPos[1];
        let element = document.getElementById(position);

        this.selectedCell = new Cell(position, x, y, element);
        this.selectedCell.element.onclick = function() {
                return false;
            };
        this.selectedCell.element.innerHTML = '<input type="number" value="' + element.innerHTML + '">';
    }

    saveCellData() {
        this.selectedCell.value = this.selectedCell.element.childNodes[0].value;
        if (this.selectedCell.value == null || this.selectedCell.value == 0) {
            this.selectedCell.element.innerHTML = 0;
            this.selectedCell.value = 0;
        } else {
            this.selectedCell.element.innerHTML = this.selectedCell.value;
        }
        this.selectedCell.element.classList.add('changed');

        crutch = table.selectedCell.id;
        this.selectedCell.element.onclick = function() {
            table.selectCell(crutch);
        };
        this.memory.push(this.selectedCell);
        this.selectedCell = false;
    }

    push() {
        let content = JSON.stringify(table.memory);
        $.ajax({
            type: "POST",
            url: '/push',
            data: {"_token": table.csrf, "cells": content},
            success: function(data) {
                // console.log('received: ', data);
                location.reload();
            }
        });
    }
}

class Cell {
    constructor(id, x, y, element, value = null) {
        this.id = id;
        this.x = x;
        this.y = y;
        this.value = value;
        this.element = element;
    }
}

var table = new TableHandler();
var crutch = '';

$(document).ready(function(){
   table.getContent();
});


