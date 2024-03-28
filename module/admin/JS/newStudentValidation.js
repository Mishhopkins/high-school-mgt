var stuGender = '';
function newStudentValidation(){
   var stuId = document.getElementById('stuId').value;
   var stuName = document.getElementById('stuName').value;
   var stuPassword = document.getElementById('stuPassword').value;
   var stuPhone = document.getElementById('stuPhone').value;
   var stuEmail = document.getElementById('stuEmail').value;
   var stuAddress = document.getElementById('stuAddress').value;
    //= document.getElementById("input[name = 'gender']:checked").value;
   var stuDOB = document.getElementById('stuDOB').value;
   var stuAddmissionDate = document.getElementById('stuAddmissionDate').value;
   var stuParentId = document.getElementById('stuParentId').value;
   var class_id = document.getElementById('class_id').value;
   var hostel_id = document.getElementById('hostel_id').value;
   var session_id = document.getElementById('session_id').value;
   

   if(!stuId){
       alert('Student Id Must be fild out.')
       return false;
   }
   else if(!stuName){
       alert('Student Name must be fild out.')
       return false;
   }
   else if(!stuPassword){
       alert('Student Password must be fild out.')
       return false;
   }
   else if(!stuPhone){
       alert('Student Phone must be fild out.')
       return false;
   }
   else if(!stuEmail){
       alert('Student Email must be fild out.')
       return false;
   }
   else if(!stuGender){
       alert('Student Gender must be fild out.')
       return false;
   }
   else if(!stuDOB){
       alert('Student Date Of Birth must be fild out.')
       return false;
   }
   else if(!stuParentId){
       alert('Student Parent Id must be fild out.')
       return false;
   }
   else if(!class_id){
       alert('Student Class Id must be fild out.')
       return false;
   }
   else if(!hostel_id){
    alert('Student Hostel Id  must be fild out.')
    return false;
    }
    else if(!session){
        alert('Student Session Id must be fild out.')
        return false;
    }
    else if(!stuAddress){
        alert('Student Address must be fild out.')
        return false;
    }
   else return true;
}
