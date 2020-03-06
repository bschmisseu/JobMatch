$(function(){
	$(document).mouseup(function (e){
		var container = $("#addEducationForm");
		
		if (!container.is(e.target)&& container.has(e.target).length === 0){
			container.fadeOut();
			}
		});
	});

function openEducationForm(){
  $('#addEducationForm').fadeToggle();
}

$(function(){
	$(document).mouseup(function (e){
		var container = $("#addJobForm");
		
		if (!container.is(e.target)&& container.has(e.target).length === 0){
			container.fadeOut();
			}
		});
	});

function openJobForm(){
  $('#addJobForm').fadeToggle();
}

$(function(){
	$(document).mouseup(function (e){
		var container = $("#addSkillForm");
		
		if (!container.is(e.target)&& container.has(e.target).length === 0){
			container.fadeOut();
			}
		});
	});

function openSkillForm(){
  $('#addSkillForm').fadeToggle();
}

$(function(){
	$(document).mouseup(function (e){
		var container = $("#editSkillForm");
		
		if (!container.is(e.target)&& container.has(e.target).length === 0){
			container.fadeOut();
			}
		});
	});

function openEditSkillForm(skillId, skillString){
  $('#editSkillForm').fadeToggle();
  document.getElementById('editSkillId').value = skillId;
  document.getElementById('editSkillString').value = skillString;
}

$(function(){
	$(document).mouseup(function (e){
		var container = $("#addJobListingForm");
		
		if (!container.is(e.target)&& container.has(e.target).length === 0){
			container.fadeOut();
			}
		});
	});

function openJobListingForm(){
  $('#addJobListingForm').fadeToggle();
}

$(function(){
	$(document).mouseup(function (e){
		var container = $("#editJobListingForm");
		
		if (!container.is(e.target)&& container.has(e.target).length === 0){
			container.fadeOut();
			}
		});
	});

function openEditJobListingForm(jobListingId, company, position, salary, skills, description){
  $('#editJobListingForm').fadeToggle();
  document.getElementById('editJobListingId').value = jobListingId;
  document.getElementById('editJobPosition').value = position;
  document.getElementById('editCompanyName').value = company;
  document.getElementById('editJobSalary').value = salary;
  document.getElementById('editJobSkills').value = skills;
  document.getElementById('editJobDescription').value = description;
}


$(function(){
	$(document).mouseup(function (e){
		var container = $("#addGroupForm");
		
		if (!container.is(e.target)&& container.has(e.target).length === 0){
			container.fadeOut();
			}
		});
	});

function openGroupForm(){
  $('#addGroupForm').fadeToggle();
}

$(function(){
	$(document).mouseup(function (e){
		var container = $("#editGroupForm");
		
		if (!container.is(e.target)&& container.has(e.target).length === 0){
			container.fadeOut();
			}
		});
	});

function openEditGroupForm(goupId, groupName){
  $('#editGroupForm').fadeToggle();
  document.getElementById('editGroupId').value = goupId;
  document.getElementById('editGroupName').value = groupName;
}