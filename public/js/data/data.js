class Data {

  /* Public */
  get(name, callback){
    this.send(null, name, this.methodEnum.get, callback);
  }
  post(){

  }
  migrate(modalId, studentName){
    this.send(studentName, this.nameEnum.migrate, this.methodEnum.post, () =>{
      $(modalId).modal("show");
    });
  }
  /* data = id column, name is nameEnum value, callback is result function*/
  delete(data, name, callback){
    this.send(data, name, this.methodEnum.delete, callback);
  }

  /* Private */
  send(data = null, name, method = this.methodEnum.get, callback = () => {}){
    var xhttp = new XMLHttpRequest();
    this.spinner();
    var spinnerFunc = this.spinner;
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                  callback(this.responseText);
                  spinnerFunc();
                }
        };
        xhttp.open(method
            ,this.getDestination(name).url + this.generateParameter(method, data)
            ,true);
        xhttp.send();
  }

  generateParameter(method, data = null){
    if(method == this.methodEnum.delete
      && data)
      return "?id=" + data + "&api_token=" + token;
    else if(data)
      return "?data=" + data + "&api_token=" + token;
    else
      return "?api_token=" + token;
  }

  getDestination(name){
    for(var i = 0; i < this.destinations.length; i++){
      if(this.destinations[i].name == name){
        return this.destinations[i];
      }
    }
    return "";
  }

  /* spinner control */
  spinner(){
    var spinner = document.getElementById('nav-spinner');
    if(spinner.style.display == "block")
      spinner.style.display = "none";
    else
      spinner.style.display = "block";
  }

  /* getters */
  get destinations(){
    return [
      {
        name: this.nameEnum.staff,
        url: "/api/staff",
        headers: ["User", "Email"]
      },
      {
        name: this.nameEnum.student,
        url: "/api/student",
        headers: ["Student"]
      },
      {
        name: this.nameEnum.migrate,
        url: "/api/migrate",
        headers: null
      },
      {
        name: this.nameEnum.computer,
        url: "/api/computer",
        headers: ["Name"]
      },
      {
        name: this.nameEnum.studenttocomputer,
        url: "/api/studenttocomputer",
        headers: ["Student", "Computer"]
      }
    ];
  }
  get methodEnum(){
    return{
      delete: "DELETE",
      get: "GET",
      post: "POST"
    }
  }
  get nameEnum(){
    return{
      staff: 0,
      student: 1,
      migrate: 2,
      computer: 3,
      studenttocomputer: 4
    }
  }

}