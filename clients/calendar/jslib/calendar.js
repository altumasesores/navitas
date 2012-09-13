// JavaScript Document

function calendar_inicio(){
	
	new vlaDatePicker('fecha_inicio', { openWith: 'togglePicker', offset: { y: -2, x: 2 }, separateInput: { day: 'day', month: 'month', year: 'year' } });		
					
	
	}

function calendar_fin(){
	
	new vlaDatePicker('fecha_fin', { openWith: 'togglePicker2', offset: { y: -2, x: 2 }, separateInput: { day: 'day', month: 'month', year: 'year' } });	
			
	
	}

function calendar_imss(){
	
	new vlaDatePicker('fecha_alta_imss', { openWith: 'togglePicker', offset: { y: -2, x: 2 }, separateInput: { day: 'day', month: 'month', year: 'year' } });			
	
	}

function calendar_nacimiento(){

	new vlaDatePicker('fecha_nacimiento', { openWith: 'togglePicker2', offset: { y: -2, x: 2 }, separateInput: { day: 'day', month: 'month', year: 'year' } });	
	
}