<!--main page contents-->

<script>

function deleteColumn(){
	var table = document.getElementById('userTable');
	var rows = table.rows.length;
	for (let i=0;i<rows;i++){
		table.rows[i].deleteCell(5);
		table.rows[i].deleteCell(4);
	}
}

function showUserInfo(id){
	// idはクリックしたviewボタンの番号(id番号)
	
	var users = <?php echo json_encode($users); ?>;
	
	var table = document.getElementById('userTable');
	var rows = table.rows.length;//横の行の数
	var cols = table.rows[0].cells.length;//縦の列の数
	
	var cell1;
	var cell2;
	//document.getElementById("memo").innerHTML += "start loop";
	for(let i=0;i<rows;i++){
		if(cols<6){
			//列が増える前の処理、列を増やしてmail, phone_numberを表示。
			
			cell1 = table.rows[i].insertCell(4);//列ごとに1セルずつ挿入する。3番目に挿入。
			cell2 = table.rows[i].insertCell(5);
			
			if(i==0){
				cell1.innerHTML="<th scope='col'><strong>Email</strong></th>";
				cell2.innerHTML="<th scope='col'><strong>Phone_number</strong></th>";
			}
			else if(id==users[i-1]["id"]){
				cell1.innerHTML = "<td>"+users[i-1]['email']+"</td>";
				cell2.innerHTML = "<td>"+users[i-1]['phone_number']+"</td>";
			}
		}
		
		else{
			// 列が増えている状態
			cell1 = table.rows[i].cells[4];
			cell2 = table.rows[i].cells[5];
			if(i>0 && id==users[i-1]["id"]){
				//すでにテーブルに詳細が表示されている場合。
				if(cell1.innerHTML != "" && cell2.innerHTML != ""){
					cell1.innerHTML = "delete";
					cell2.innerHTML = "delete";
					deleteColumn();
					break;
				}
				
				else{
					cell1.innerHTML = "<td>"+users[i-1]['email']+"</td>";
					cell2.innerHTML = "<td>"+users[i-1]['phone_number']+"</td>";
				}
			}
		}
	}
}

function checkBox(){

	var users = <?php echo json_encode($users); ?>;
	
	const checkbox=document.getElementsByName("check");
	
	var delUser = [];
	
	for (let i=0;i<checkbox.length;i++){
		if(checkbox[i].checked){
			delUser.push(users[i]["id"]);
		}
	}
	
	$(document).ready(function(){// load待ち
		

		$("#deleteButton").click(function(){
			document.getElementById("memo").innerHTML += "Nothing";
			var data = {
				deluser : delUser
			};
			
			$.ajax({
				type: "get",
				url: "",
				data: data
			})
			.then(
				function(){//通信成功時
					alert("success!");
				},
				function(){
					alert("fault!");
			});
		});
	}
	);
	
	
//	//表示部分
//	document.getElementById("memo").innerHTML = "";
//	if(delUser.length==0){
//		document.getElementById("memo").innerHTML += "Nothing";
//	}
//	else{
//		for(let i=0;i<delUser.length;i++){
//			document.getElementById("memo").innerHTML += delUser[i];
//		}
//	}
}

</script>

<main role="main" class="flex-shrink-0">
  <div class="container">
      <h1><?php echo $page_title; ?></h1>
      <table class="table table-striped table-hover" id="userTable">
          <thead>
              <tr>
              <th scope="col">ChBox</th>
              <th scope="col">#</th>
              <th scope="col">First Name</th>
              <th scope="col">Last Name</th>
              <th scope="col">Action</th>
              </tr>
          </thead>
          <tbody>
              <?php foreach ($users as $user): ?>
                  <tr>
                  <td><input type="checkbox" name="check" ></td>
                  <th scope="row"><?php echo $user["id"]; ?></th><!--$user[id]の番号-->
                  <td><?php echo $user["first_name"]; ?></td>
                  <td><?php echo $user["last_name"]; ?></td>
                  <td>
                      <!--<a href="#"><button class="btn btn-primary btn-sm">View</button></a>-->
                      <a href="javascript:showUserInfo('<?php echo $user["id"]; ?>')"><button class="btn btn-primary btn-sm">View</button></a>
                      <a href="<?php echo site_url("users/update/$user[id]"); ?>"><button class="btn btn-outline-primary btn-sm">Edit</button></a>

                      <a onclick="return confirm('Are you sure to delete this user?')" href="<?php echo site_url("users/delete/$user[id]"); ?>"><button class="btn btn-sm">Delete</button></a>
                  </td>
                  </tr>
              <?php endforeach; ?>
          </tbody>
      </table>
      
      <a href="javascript:checkBox()"><button id="deleteButton" class="btn btn-danger">Delete</button></a>
      <!--
       <a onclick="return confirm('Are you sure to delete these user?')" href="javascript:checkBox()"><button class="btn btn-danger">Delete</button></a>
      -->
  </div>
  
  <p id="memo">memo</p>
  
</main>
