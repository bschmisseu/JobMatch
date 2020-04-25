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

function openApplyJobListingForm(jobListingId, company, position, salary, skills, description){
	  $('#applyJobListingForm').fadeToggle();
	  document.getElementById('applyJobListingId').value = jobListingId;
	  document.getElementById('applyJobPosition').value = position;
	  document.getElementById('applyCompanyName').value = company;
	  document.getElementById('applyJobSalary').value = salary;
	  document.getElementById('applyJobSkills').value = skills;
	  document.getElementById('applyJobDescription').value = description;
	}

$(function(){
	$(document).mouseup(function (e){
		var container = $("#applyJobListingForm");
		
		if (!container.is(e.target)&& container.has(e.target).length === 0){
			container.fadeOut();
			}
		});
	});


$(function(){
	$(document).mouseup(function (e){
		var container = $("#editUserInfo");
		
		if (!container.is(e.target)&& container.has(e.target).length === 0){
			container.fadeOut();
			}
		});
	});

function openEditUserInfoForm(userId, firstName, lastName, phoneNumber, email, username, password, bio){
  $('#editUserInfo').fadeToggle();
  document.getElementById('editUserId').value = userId;
  document.getElementById('editFirstName').value = firstName;
  document.getElementById('editLastName').value = lastName;
  document.getElementById('editPhoneNumber').value = phoneNumber;
  document.getElementById('editEmail').value = email;
  document.getElementById('editUserName').value = username;
  document.getElementById('editPassword').value = password;
  document.getElementById('editBio').value = bio;
  
}