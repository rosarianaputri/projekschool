@extends('layouts.admin')

@section('content')
<div class="mb-4">
    <h4>{{ isset($grade) ? 'Edit Nilai' : 'Tambah Nilai Baru' }}</h4>
    <p class="text-muted">Simpan nilai siswa lengkap dengan kategori dan catatan.</p>
</div>

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ isset($grade) ? route('teacher.grades.update', $grade) : route('teacher.grades.store') }}" method="POST">
    @csrf
    @if(isset($grade))
        @method('PUT')
    @endif

    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Kelas</label>
            <select name="teacher_class_id" id="classSelect" class="form-select" required>
                <option value="">Pilih kelas</option>
                @foreach($classes as $class)
                    <option value="{{ $class->id }}" {{ old('teacher_class_id', $grade->teacher_class_id ?? '') == $class->id ? 'selected' : '' }}>{{ $class->name }} - {{ $class->subject }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label">Nama Siswa</label>
            <input type="hidden" name="student_name" id="studentNameHidden" value="{{ old('student_name', $grade->student_name ?? '') }}">
            <select id="studentSelect" class="form-select" disabled>
                <option value="">Pilih kelas terlebih dahulu</option>
            </select>
            <input type="text" id="studentText" class="form-control mt-2 d-none" value="{{ old('student_name', $grade->student_name ?? '') }}" placeholder="Masukkan nama siswa jika tidak tersedia" />
            <small class="text-muted d-block mt-2">Siswa akan muncul berdasarkan kelas yang dipilih. Jika belum ada siswa, ketik nama siswa secara manual.</small>
        </div>
        <div class="col-md-6">
            <label class="form-label">Kategori Nilai</label>
            <input type="text" name="category" class="form-control" value="{{ old('category', $grade->category ?? '') }}" placeholder="Pengetahuan / Keterampilan / Sikap">
        </div>
        <div class="col-md-3">
            <label class="form-label">Nilai</label>
            <input type="number" min="0" max="100" name="score" class="form-control" value="{{ old('score', $grade->score ?? '') }}" required>
        </div>
        <div class="col-md-3">
            <label class="form-label">Catatan</label>
            <input type="text" name="note" class="form-control" value="{{ old('note', $grade->note ?? '') }}">
        </div>
    </div>

    <div class="mt-4">
        <button type="submit" class="btn btn-primary">
            <i class="feather-save me-2"></i>
            {{ isset($grade) ? 'Simpan Perubahan' : 'Simpan Nilai' }}
        </button>
        <a href="{{ route('teacher.grades.index') }}" class="btn btn-outline-secondary">Kembali</a>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const classSelect = document.getElementById('classSelect');
        const studentSelect = document.getElementById('studentSelect');
        const studentText = document.getElementById('studentText');

        const studentsByClass = {
            @foreach($classes as $class)
                "{{ $class->id }}": [
                    @foreach($class->students as $student)
                        {
                            id: "{{ $student->id }}",
                            name: "{{ addslashes($student->name) }}",
                            nis: "{{ addslashes($student->nis ?? '') }}"
                        },
                    @endforeach
                ],
            @endforeach
        };

        const selectedStudent = "{{ old('student_name', $grade->student_name ?? '') }}";

        function setStudentOptions(classId) {
            studentSelect.innerHTML = '';
            const defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.textContent = classId ? 'Pilih siswa' : 'Pilih kelas terlebih dahulu';
            studentSelect.appendChild(defaultOption);

            const students = studentsByClass[classId] || [];
            students.forEach(student => {
                const option = document.createElement('option');
                option.value = student.name;
                option.textContent = student.name + (student.nis ? ' (' + student.nis + ')' : '');
                if (student.name === selectedStudent) {
                    option.selected = true;
                }
                studentSelect.appendChild(option);
            });

            studentNameHidden.value = studentSelect.value || '';
            return students.length > 0;
        }

        function updateStudentFields() {
            const selectedClass = classSelect.value;
            const hasStudents = selectedClass && setStudentOptions(selectedClass);

            if (selectedClass && hasStudents) {
                studentSelect.classList.remove('d-none');
                studentSelect.disabled = false;
            studentText.classList.add('d-none');
            studentText.disabled = true;
            studentNameHidden.value = studentSelect.value;
        } else if (selectedClass && !hasStudents) {
            studentSelect.classList.remove('d-none');
            studentSelect.disabled = true;
            studentText.classList.remove('d-none');
            studentText.disabled = false;
            studentText.focus();
            studentNameHidden.value = studentText.value;
        } else {
            studentSelect.classList.remove('d-none');
            studentSelect.disabled = true;
            studentText.classList.add('d-none');
            studentText.disabled = true;
            studentNameHidden.value = '';
        }
    }

    studentSelect.addEventListener('change', function () {
        studentNameHidden.value = this.value;
    });

    studentText.addEventListener('input', function () {
        studentNameHidden.value = this.value;
    });

    classSelect.addEventListener('change', updateStudentFields);
    updateStudentFields();
</script>
@endsection
