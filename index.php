<!DOCTYPE html>
    <html lang="en">
    <head>
        <title>通訊錄</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    </head>
    <body>

    <div class="container" id="contactApp">
        <div class="col-md-6" align="right">
            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" value="Add">新增資料</button>
        </div>
        <table class="table table-hover">
            <tr>
                <th>姓名</th>
                <th>性別</th>
                <th>地址</th>
                <th>電話</th>
                <th>生日</th>
            </tr>
            <tr v-for="row in allData">
                <td>{{ row.name }}</td>
                <td>{{ row.sex }}</td>
                <td>{{ row.address }}</td>
                <td>{{ row.phone }}</td>
                <td>{{ row.birth }}</td>
            </tr>
        </table>
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
            
            <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">薪資資料</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" v-model="name" id="name">
                        </div>
                        <div class="form-group">
                            <label for="sex">Sex:</label>
                            <select class="form-control" v-model="sex" id="sex">
                                <option value="男">男</option>
                                <option value="女">女</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <input type="text" class="form-control" v-model="address" id="address">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone:</label>
                            <input type="text" class="form-control" v-model="phone" id="phone">
                        </div>
                        <div class="form-group">
                            <label for="birth">Birthday:</label>
                            <input type="date" class="form-control" v-model="birth" id="birth">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-default" data-dismiss="modal"  @click="submitData" />新增</button>
                    </div>
                </div>
            
            </div>
        </div>
    </div>

    </body>
</html>
<script>

var application = new Vue({
    el:'#contactApp',
    data:{
        allData:'',
        myModel:false,
    },
    methods:{
        fetchAllData:function(){
            axios.post('action.php', {
            action:'fetchall'
            }).then(function(response){
                application.allData = response.data;
            });
        },
        submitData:function(){
            axios.post('action.php', {
                action:'insert',
                name:application.name, 
                sex:application.sex,
                address:application.address,
                phone:application.phone,
                birth:application.birth
            }).then(function(response){
                application.myModel = false;
                application.fetchAllData();
                application.name = '';
                application.sex = '';
                application.address = '';
                application.phone = '';
                application.birth = '';
                alert(response.data.message);
            });
        }
    },
    created:function(){
        this.fetchAllData();
    }
});

</script>
