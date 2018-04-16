@extends('layouts.master')
@section('content')
<div class="baseBoard">
    <div name="userInfo">
        <div>
            <div>이미지</div><div></div>
            <div>ID</div><div></div>
            
            <div>비밀번호</div><div></div>
            <div>이름</div><div></div>
            <div>포인트</div><div></div>
            <div></div><div></div>
            <div></div><div></div>
        </div>
    </div>
    <div name="accountBook">
        <div>구매 내역</div><div></div>
        <div>최근 판매 내역</div><div></div>
        
    </div>
    <div name="attendanceCheck">
        <table class="table calendar">
            <tr>
                <th>
                    일
                </th>
                <th>
                    월
                </th>
                <th>
                    화
                </th>
                <th>
                    수
                </th>
                <th>
                    목
                </th>
                <th>
                    금
                </th>
                <th>
                    토
                </th>
            </tr>
            <tr>
                <td></td>
            </tr>
        </table>
    </div>
</div>





@endsection