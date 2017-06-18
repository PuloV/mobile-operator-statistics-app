<tr id='entry{{id}}'>
  <td>{{name}}</td>
  <td>{{gender}}</td>
  <td>{{age}}</td>
  <td>{{operator}}</td>
  <td>{{date}}</td>
  <?php if(Server::getPerson()->isAdmin()) { ?>
  <td>
  	<input class="btn btn-warning editEntry" data-id="{{id}}" value="Edit" type="button">
  	<input class="btn btn-danger deleteEntry" data-id="{{id}}" value="Delete" type="button">
  </td>
  <?php } ?>
</tr>