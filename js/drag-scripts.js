/*jslint white: true, browser: true, undef: true, nomen: true, eqeqeq: true, plusplus: false, bitwise: true, regexp: true, strict: true, newcap: true, immed: true, maxerr: 14 */
/*global window: false, REDIPS: true */

/* enable strict mode */
"use strict";

// define redipsInit variable
var redipsInit;

var redips = {},		// redips container
    rd = REDIPS.drag,	// reference to the REDIPS.drag library
    counter = 0,		// counter for cloned DIV elements
    clonedDIV = false,	// cloned flag set in event.moved
    lastCell;

// redips initialization
redipsInit = function () {
    // reference to the REDIPS.drag library and message line
    var	rd = REDIPS.drag,
        msg;
    // initialization
    rd.init();
    // set hover color for TD and TR
    rd.hover.colorTd = '#FFCFAE';
    rd.hover.colorTr = '#9BB3DA';
    rd.shift.animation = true;
    // set hover border for current TD and TR
    rd.hover.borderTd = '2px solid #32568E';
    rd.hover.borderTr = '2px solid #32568E';
    // drop row after highlighted row (if row is dropped to other tables)
    rd.rowDropMode = 'after';
    // row was clicked - event handler
    rd.event.rowClicked = function () {
        // set current element (this is clicked TR)
        var el = rd.obj;
        // find parent table
        el = rd.findParent('TABLE', el);
        // every table has only one SPAN element to display messages
        msg = el.getElementsByTagName('span')[0];
        // display message
       // msg.innerHTML = 'Clicked';
    };
    // row was moved - event handler
    rd.event.rowMoved = function () {
        // set opacity for moved row
        // rd.obj is reference of cloned row (mini table)
        rd.rowOpacity(rd.obj, 85);
        // set opacity for source row and change source row background color
        // rd.objOld is reference of source row
        rd.rowOpacity(rd.objOld, 20, 'White');
        // display message
       // msg.innerHTML = 'Moved';
    };
    // row was not moved - event handler
    rd.event.rowNotMoved = function () {
        //msg.innerHTML = 'Not moved';
    };
    // row was dropped - event handler
    rd.event.rowDropped = function () {
        // display message
       // msg.innerHTML = 'Dropped';
    };
    // row was dropped to the source - event handler
    // mini table (cloned row) will be removed and source row should return to original state
    rd.event.rowDroppedSource = function () {
        // make source row completely visible (no opacity)
        rd.rowOpacity(rd.objOld, 100);
        // display message
        //msg.innerHTML = 'Dropped to the source';
    };
    /*
     // how to cancel row drop to the table
     rd.event.rowDroppedBefore = function () {
     //
     // JS logic
     //
     // return source row to its original state
     rd.rowOpacity(rd.objOld, 100);
     // cancel row drop
     return false;
     }
     */
    // row position was changed - event handler
    rd.event.rowChanged = function () {
        // get target and source position (method returns positions as array)
        var pos = rd.getPosition();
        // display current table and current row
       // msg.innerHTML = 'Changed: ' + pos[0] + ' ' + pos[1];
    };
//tirar isso mais tarde

    rd.event.moved = function (cloned) {
        clonedDIV = cloned;
    };

    $('#dialog').dialog({
        autoOpen: false,
        resizable: false,
        modal: true,
        width: 400,
        height: 170,
        // define Shift, Switch and Overwrite buttons
        buttons: {
            'Agrupar': function () {
                // enable elements in target cell (return solid border)
                rd.enableDrag(true, rd.td.target);
                // DIV element is cloned then shift cells to the last TD
                if (clonedDIV) {
                    rd.shiftCells(lastCell, rd.td.target);
                }
                // if DIV element is dragged within table then shift cells
                // from source to target TD position
                else {
                    rd.shiftCells(rd.td.source, rd.td.target);
                }
                // append previously removed DIV to the target cell
                rd.td.target.appendChild(rd.obj);
                // close dialog
                $(this).dialog('close');
            },
            'Trocar': function () {
                // enable elements in target cell (return solid border) in both cases
                rd.enableDrag(true, rd.td.target);
                // switch elements only if current DIV element is not cloned
                if (!clonedDIV) {
                    // relocate target and source cells
                    rd.relocate(rd.td.target, rd.td.source);
                    // append previously removed DIV to the target cell
                    rd.td.target.appendChild(rd.obj);
                }
                // close dialog
                $(this).dialog('close');
            }


        },
        // action when dialog is closed
        close: function (event, ui) {
            // return dragged DIV element to the source cell only if X button is clicked
            // (in this case event.which property exists)
            if (event.which) {
                // enable elements in target cell (return solid border)
                rd.enableDrag(true, rd.td.target);
                // if and DIV element is not cloned then return in to source cell
                if (!clonedDIV) {
                    // append previously removed DIV to the target cell
                    rd.td.source.appendChild(rd.obj);
                }
            }
        }
    });

};


// add onload event listener
if (window.addEventListener) {
    window.addEventListener('load', redipsInit, false);
}
else if (window.attachEvent) {
    window.attachEvent('onload', redipsInit);
}/**
 * Created by joao.landino on 30/11/2015.
 */
