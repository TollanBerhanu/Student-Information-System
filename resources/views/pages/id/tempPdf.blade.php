

 {{-- Extends layout --}}
 @extends('layout.empty')

 {{-- Content --}}
 


 @foreach($selectedStudents as $stud)
            {{-- {{ $stud[0]->first_name }} <br> --}}
            <div class="bg-white" style="width: 45%; display:inline-block; margin: 10px; float:left;">
                <div class="col-md-12">
                    <table class="table table-borderless" style="border: 1px solid #333; border-bottom: none; margin: 0px;">
                        <thead>
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
                        </thead>
                    </table>
                    <table class="table table-borderless" style="border: 1px solid #333; border-top: 1px dotted #333; margin: 0px;">
                        <tbody>
                            <tr>
                                <td rowspan="4" style="padding:60px 0px; text-align:center; border: 1px solid #333; width: 30%;"> Photo </td>
                                <td style="padding: 5px 15px">Name:<span class="font-weight-bold text-dark"> {{ $stud[0]->first_name." ".$stud[0]->middle_name." ".$stud[0]->last_name }}</span></td>
                            </tr>
                            <tr>
                                <td style="padding: 5px 15px">Program: <span class="font-weight-bold text-dark">{{ $stud[0]->program->department->name }}</span></td>
                            </tr>
                            <tr>
                                <td style="padding: 5px 15px">ID No:<span class="font-weight-bold text-dark"> {{ $stud[0]->student_id }}</span></td>
                            </tr>
                            <tr>
                                <td style="padding: 10px">
                                    <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($stud[0]->student_id, 'C39+',1.4,40,array(0,0,0), true)}}" alt="barcode" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
             </div>
        @endforeach

      