<tr id='entry{{id}}'>
  <td>{{user_name}}</td>
  <td>{{email}}</td>
  <td>
	<select id='role{{id}}' name='role' class="form-control android">
		<option value='user' {{selected_user}}>User</option>
		<option value='admin' {{selected_admin}}>Admin</option>
	</select>
  </td>
  <td>
  	<input class="btn btn-warning editEntry" data-id="{{id}}" value="Change Role" type="button">
  	<input class="btn btn-danger deleteEntry" data-id="{{id}}" value="Delete" type="button">
  </td>
</tr>