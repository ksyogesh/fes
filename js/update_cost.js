
/*
 *Update_cost.js
 * 
 * Copyright 2012 CSLabs GECH <cse.gechassan@gmail.com>
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 * 
 * 
 */


function UpdateCost() {
  var sum = 0;
  for (i=0;i<111;i++){
    if(document.feedback_form[i].type=='radio')
	if(document.feedback_form[i].checked == true){
	sum+=parseInt(document.feedback_form[i].value);
  }
 document.feedback_form['total'].value=sum;
} 
}

function UpdateCost1() {
  var sum = 0;
  for (j=111;j<212;j++){
    if(document.feedback_form[j].type=='radio')
	if(document.feedback_form[j].checked == true){
	sum+=parseInt(document.feedback_form[j].value);
  }
 document.feedback_form['total1'].value=sum;
} 
}


function UpdateCost2() {
  var sum = 0;
  for (n=212;n<312;n++){
    if(document.feedback_form[n].type=='radio')
	if(document.feedback_form[n].checked == true){
	sum+=parseInt(document.feedback_form[n].value);
  }
 document.feedback_form['total2'].value=sum;
} 
}

function UpdateCost3() {
  var sum = 0;
  for (i=312;i<415;i++){
    if(document.feedback_form[i].type=='radio')
	if(document.feedback_form[i].checked == true){
	sum+=parseInt(document.feedback_form[i].value);
  }
 document.feedback_form['total3'].value=sum;
} 
}



function UpdateCost4() {
  var sum = 0;
  for (i=415;i<525;i++){
    if(document.feedback_form[i].type=='radio')
	if(document.feedback_form[i].checked == true){
	sum+=parseInt(document.feedback_form[i].value);
  }
 document.feedback_form['total4'].value=sum; 
}
}

function UpdateCost5() {
  var sum = 0;
  for (i=525;i<666;i++){
    if(document.feedback_form[i].type=='radio')
	if(document.feedback_form[i].checked == true){
	sum+=parseInt(document.feedback_form[i].value);
  }
 document.feedback_form['total5'].value=sum; 
}
}
