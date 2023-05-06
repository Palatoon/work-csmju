if (lang_checker == 'en') {
    var lang = 'en';
    var dt_lang = {};
    var login_via = 'Login via';
    var log_off = 'Log off';
    var swal_lang = {
        'alert': 'Alert',
        'caution': 'Caution',
        'confirm': 'Confirm',
        'logout': 'Logout',
        'continue': 'Continue',
        'continue_action': 'Are you sure that you want to continue?',

        'add_room': 'Are you sure that you want to add this room?',
        'update_room': 'Are you sure that you want to update this room?',
        'delete_room': 'Are you sure that you want to delete this room?',
        'booking_room': 'Are you sure that you want to booking this room?',
        'disable_room': 'Are you sure that you want to disable this room?',
        'enable_room': 'Are you sure that you want to enable this room?',

        'approve_booking': 'Are you sure that you want to approve this booking?',
        'update_booking': 'Are you sure that you want to update this booking?',
        'reject_booking': 'Are you sure that you want to reject this booking?',
        'cancel_booking': 'Are you sure that you want to cancel this booking?',
        'cancel_booking_request': ' Are you sure that you want to cancel this booking request?',

        'change_role': "Are you sure that you want to change this user's role?",

        'fill_name': 'Please fill out name.',
        'fill_name_email_seat': 'Please fill out name, email and seat.',
        'required': 'Please fill in all the required fields.',

        'add_room_type': 'Are you sure that you want to add this room type?',
        'update_room_type': 'Are you sure that you want to update this room type?',
        'delete_room_type': 'Are you sure that you want to delete this room type?',

        'add_device': 'Are you sure that you want to add this device?',
        'update_device': 'Are you sure that you want to update this device?',
        'delete_device': 'Are you sure that you want to delete this device?',
        'sync_device': 'Are you sure that you want to sync devices this room?',

        'add_group': 'Are you sure that you want to add this group?',
        'update_group': 'Are you sure that you want to update this group?',
        'delete_group': 'Are you sure that you want to delete this group?',

        'add_permission': 'Are you sure that you want to add permission to this user?',

        'add_config': 'Are you sure that you want to add this configuration?',
        'update_config': 'Are you sure that you want to update this configuration?',
        'delete_config': 'Are you sure that you want to delete this configuration?',

        'room_must_approved': '** This room must be approved by a moderator **',
        'room_limit_group': 'The rooms are limited to these groups only.'
    };
    var toastr_lang = {
        'pd': 'Processing Data',
        'pc': 'Process Complete',
        'error_try_again': 'Something went wrong Please try again.',
        'email_format_incorrect': 'The email address format is incorrect.',

        'room_loading': 'Room #x# Loading ..',
        'cannot_modify': 'You cannot modify this booking.',
        'elapsed_period': 'You cannot make reservations, amendments and cancellations during the elapsed period.',
        'wrong_time': 'You chose the wrong time. Please check again.',

        'qouta_dup_other': 'Can not make the same reservation with other people.',
        'qouta_dup_self': 'You have already booked another room at that time or must leave the time from the previous booking #x# minutes',
        'qouta_dup_booking': 'Others have already reserved the period or must leave the time from the previous booking #x# minutes',
        'qouta_not_in_group': 'You are not in the group that can reserve such a room!',
        'qouta_day_advance': 'You can reserve up to #x# days in advance.',
        'qouta_time_a_week': 'You can use them no more than #x# times a week!',
        'qouta_time_a_day': 'You can use it no more than #x# times a day!',
        'qouta_time_a_week_user': 'This user reaches quota #x# times per week!',
        'qouta_time_a_day_user': 'This user has reached the quota #x# times per day!',
        'qouta_participant': 'The total number of participants is limited to #x# people, including the reserved person.',
        'qouta_max_hour': 'You can reserve a maximum of #x# an hour.',
        'qouta_min_hour': 'You can book from #x# hours and up.',

        'booking_approved': 'The booking has been approved.',
        'update_fail': 'Update failed',
        'delete_fail': 'Deletion failed',
        'refuse_fail': 'Error: Failed to refuse.',
        'cancel_fail': 'Error: Failed to cancel.',
        'update_role_fail': 'An error occurred updating role permissions.',

        'update_success': 'Successfully updated',
        'delete_success': 'The data has been deleted.',
        'decline_success': 'Successfully declined',
        'cancel_success': 'Canceled',

        'limit_compare': 'Limited 5 room'
    };
} else {
    var lang = 'th';
    var dt_lang = {
        "sProcessing": "กำลังดำเนินการ...",
        "sLengthMenu": "แสดง_MENU_ แถว",
        "sZeroRecords": "ไม่พบข้อมูล",
        "sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
        "sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 แถว",
        "sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
        "sInfoPostFix": "",
        "sSearch": "ค้นหา:",
        "sUrl": "",
        "oPaginate": {
            "sFirst": "เิริ่มต้น",
            "sPrevious": "ก่อนหน้า",
            "sNext": "ถัดไป",
            "sLast": "สุดท้าย"
        }
    };
    var login_via = 'เข้าสู่ระบบผ่าน';
    var log_off = 'ออกจากระบบ';
    var swal_lang = {
        'alert': 'แจ้งเตือน',
        'caution': 'ข้อควรระวัง',
        'confirm': 'ยืนยัน',
        'logout': 'ออกจากระบบ',
        'continue': 'ดำเนินการต่อ',
        'continue_action': 'คุณแน่ใจหรือว่าต้องการดำเนินการต่อ?',

        'add_room': 'คุณแน่ใจหรือว่าต้องการเพิ่มห้องนี้?',
        'update_room': 'คุณแน่ใจหรือว่าต้องการอัปเดตห้องนี้?',
        'delete_room': 'คุณแน่ใจไหมว่าต้องการลบห้องนี้?',
        'booking_room': 'คุณแน่ใจหรือว่าต้องการจองห้องนี้?',
        'disable_room': 'คุณแน่ใจไหมว่าต้องการปิดการใช้งานห้องนี้?',
        'enable_room': 'คุณแน่ใจไหมว่าต้องการเปิดใช้ห้องนี้?',

        'approve_booking': 'คุณแน่ใจหรือว่าต้องการอนุมัติการจองนี้?',
        'update_booking': 'คุณแน่ใจไหมว่าต้องการอัปเดตการจองนี้?',
        'reject_booking': 'คุณแน่ใจหรือไม่ว่าต้องการปฏิเสธการจองนี้?',
        'cancel_booking': 'คุณแน่ใจหรือว่าต้องการยกเลิกการจองนี้?',
        'cancel_booking_request': 'คุณแน่ใจหรือไม่ว่าต้องการยกเลิกคำขอจองนี้?',

        'change_role': 'คุณแน่ใจหรือไม่ว่าต้องการเปลี่ยนบทบาทของผู้ใช้รายนี้?',

        'fill_name': 'กรุณากรอกชื่อ',
        'fill_name_email_seat': 'กรุณากรอกชื่ออีเมลและที่นั่ง',
        'required': 'กรุณากรอกข้อมูลในฟิลด์ที่จำเป็นทั้งหมด',

        'add_room_type': 'คุณแน่ใจหรือว่าต้องการเพิ่มประเภทห้องนี้?',
        'update_room_type': 'คุณแน่ใจหรือว่าต้องการอัปเดตประเภทห้องนี้?',
        'delete_room_type': 'คุณแน่ใจไหมว่าต้องการลบประเภทห้องนี้?',

        'add_device': 'คุณแน่ใจหรือว่าต้องการเพิ่มอุปกรณ์นี้?',
        'update_device': 'คุณแน่ใจหรือว่าต้องการอัปเดตอุปกรณ์นี้?',
        'delete_device': 'คุณแน่ใจไหมว่าต้องการลบอุปกรณ์นี้?',
        'sync_device': 'คุณแน่ใจไหมว่าต้องการซิงค์อุปกรณ์ในห้องนี้?',

        'add_group': 'คุณแน่ใจหรือว่าต้องการเพิ่มกลุ่มนี้?',
        'update_group': 'คุณแน่ใจหรือว่าต้องการอัปเดตกลุ่มนี้?',
        'delete_group': 'คุณแน่ใจไหมว่าต้องการลบกลุ่มนี้?',

        'add_permission': 'คุณแน่ใจหรือไม่ว่าต้องการเพิ่มสิทธิ์ให้กับผู้ใช้รายนี้?',

        'add_config': 'คุณแน่ใจไหมว่าต้องการเพิ่มการกำหนดค่านี้?',
        'update_config': 'คุณแน่ใจหรือว่าต้องการอัปเดตการกำหนดค่านี้?',
        'delete_config': 'คุณแน่ใจไหมว่าต้องการลบการกำหนดค่านี้?',

        'room_must_approved': '** ห้องนี้ต้องได้รับการอนุมัติจากผู้ดูแล **',
        'room_limit_group': 'ห้องพัก จำกัด เฉพาะกลุ่มเหล่านี้เท่านั้น'
    };
    var toastr_lang = {
        'pd': 'กำลังประมวลผลข้อมูล',
        'pc': 'กระบวนการเสร็จสมบูรณ์',
        'error_try_again': 'เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง',
        'email_format_incorrect': 'รูปแบบที่อยู่อีเมลไม่ถูกต้อง',

        'room_loading': 'ห้อง #x# กำลังโหลด ..',
        'cannot_modify': 'คุณไม่สามารถแก้ไขการจองนี้ได้',
        'elapsed_period': 'คุณไม่สามารถทำการจอง แก้ไข และยกเลิกในช่วงเวลาที่ผ่านไปแล้ว',
        'wrong_time': 'คุณเลือกช่วงเวลาไม่ถูกต้อง กรุณาตรวจสอบอีกครั้ง',

        'qouta_dup_other': 'ไม่สามารถจองซ้ำกับผู้อื่นได้.',
        'qouta_dup_self': 'คุณได้จองห้องอื่นเวลาดังกล่าว หรือต้องเว้นระยะห่างเวลาจากการจองก่อนหน้า #x# นาที.',
        'qouta_dup_booking': 'ผู้อื่นจองช่วงเวลาดังกล่าวแล้ว หรือต้องเว้นระยะห่างเวลาจากการจองก่อนหน้า #x# นาที.',
        'qouta_not_in_group': 'คุณไม่ได้อยู่ในกลุ่มที่สามารถจองห้องดังกล่าวได้!',
        'qouta_day_advance': 'คุณสามารถจองล่วงหน้าได้ไม่เกิน #x# วัน.',
        'qouta_time_a_week': 'คุณสามารถใช้งานได้ไม่เกิน #x# ครั้งต่อสัปดาห์!',
        'qouta_time_a_day': 'คุณสามารถใช้งานได้ไม่เกิน #x# ครั้งต่อวัน!',
        'qouta_time_a_week_user': 'ผู้ใช้งานนี้ใช้งานครบโควต้า #x# ครั้งต่อสัปดาห์!',
        'qouta_time_a_day_user': 'ผู้ใช้งานนี้ใช้งานครบโควต้า #x# ครั้งต่อวัน!',
        'qouta_participant': 'จำกัดผู้เข้ารวมเพียง #x# คน รวมถึงตัวผู้จองด้วย',
        'qouta_max_hour': 'คุณสามารถจองได้ไม่เกิน #x# ชั่วโมง.',
        'qouta_min_hour': 'คุณสามารถจองได้ตั้งแต่ #x# ชั่วโมงขึ้นไป.',

        'booking_approved': 'การจองได้รับการอนุมัติเรียบร้อยแล้ว',
        'update_fail': 'การอัพเดทล้มเหลว',
        'delete_fail': 'การลบล้มเหลว',
        'refuse_fail': 'ข้อผิดพลาด: ล้มเหลวในการปฏิเสธ',
        'cancel_fail': 'ข้อผิดพลาด: ล้มเหลวในการยกเลิก',
        'update_role_fail': 'เกิดข้อผิดพลาดในการอัปเดตบทบาทสิทธิ์',

        'update_success': 'อัปเดตเรียบร้อยแล้ว',
        'delete_success': 'ลบข้อมูลเรียบร้อยแล้ว',
        'decline_success': 'ปฏิเสธเรียบร้อยแล้ว',
        'cancel_success': 'ยกเลิกเรียบร้อยแล้ว',

        'limit_compare': 'จำกัด 5 ห้อง'
    };
}