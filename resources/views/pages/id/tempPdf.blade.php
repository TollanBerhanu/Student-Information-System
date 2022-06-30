@foreach($selectedStudents as $stud)
            {{-- {{ $stud[0]->first_name }} <br> --}}
            <div class="bg-white" style="width: 45%; display:inline-block; margin: 10px;">
                <div class="col-md-12">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td>
                                    <img src="{{ asset('images/ID Templates/JU_Logo.png') }}" alt="JU Logo" height="50">
                                </td>
                                <td>
                                    <div class="d-flex flex-column"> <span class="text-left head">Jimma University</span> <span class="text-left bottom">ጅማ ዩኒቨርሲቲ</span> </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column"> <span class="text-left head">Students Identification Card</span> <span class="text-left bottom">የተማሪዎች መታወቂያ ካርድ</span> </div>
                                </td>
                            </tr>
                            <tr>
                                <td rowspan="3" style="padding:40px 0px; text-align:center; border: 1px solid #333; width: 25%;"> Photo </td>
                                <td colspan="2">Name: {{ $stud[0]->first_name." ".$stud[0]->middle_name." ".$stud[0]->last_name }}</td>
                            </tr>
                            <tr>
                                <td colspan="2">Program: {{ $stud[0]->program->department->name }}</td>
                            </tr>
                            <tr>
                                <td colspan="2">ID No: {{ $stud[0]->student_id }}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    barcode
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
             </div>
        @endforeach
