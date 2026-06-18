@extends('admin.layouts.app')

@section('title', 'Template & Export Data')

@section('content')
<style>
    .tpl-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(340px, 1fr));
        gap: 20px;
    }
    .tpl-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid rgba(226, 232, 240, 0.6);
        padding: 24px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: all 0.2s ease;
    }
    .tpl-card:hover {
        border-color: rgba(99, 102, 241, 0.2);
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
    }
    .tpl-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: rgba(99, 102, 241, 0.06);
        color: #6366f1;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 16px;
    }
    .tpl-title {
        font-size: 1rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 6px;
        letter-spacing: -0.01em;
    }
    .tpl-desc {
        font-size: 0.8rem;
        color: #94a3b8;
        line-height: 1.4;
        margin-bottom: 16px;
    }
    .tpl-fields {
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
        margin-bottom: 20px;
    }
    .tpl-field {
        font-size: 0.65rem;
        background: #f8fafc;
        color: #64748b;
        padding: 3px 8px;
        border-radius: 5px;
        font-weight: 600;
        border: 1px solid rgba(226,232,240,0.6);
    }
    .tpl-actions {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 8px;
    }
    .tpl-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 9px 14px;
        border-radius: 8px;
        font-family: inherit;
        font-size: 0.78rem;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.15s;
        border: none;
    }
    .tpl-btn-outline {
        background: transparent;
        color: #6366f1;
        border: 1px solid rgba(99, 102, 241, 0.25);
    }
    .tpl-btn-outline:hover {
        background: rgba(99, 102, 241, 0.04);
        border-color: rgba(99, 102, 241, 0.4);
    }
    .tpl-btn-green {
        background: #10b981;
        color: #ffffff;
    }
    .tpl-btn-green:hover {
        background: #059669;
    }
    .tpl-import {
        margin-top: 16px;
        border-top: 1px solid rgba(226, 232, 240, 0.6);
        padding-top: 14px;
    }
    .tpl-import-label {
        font-size: 0.65rem;
        font-weight: 600;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        margin-bottom: 8px;
    }
    .tpl-import-row {
        display: flex;
        gap: 8px;
        align-items: center;
    }
    .tpl-import-row input[type="file"] {
        font-size: 0.75rem;
        padding: 6px 10px !important;
        border-radius: 8px !important;
        flex: 1;
        min-width: 0;
    }
    .tpl-btn-upload {
        background: #6366f1;
        color: #ffffff;
        border: none;
        padding: 7px 14px;
        border-radius: 8px;
        font-family: inherit;
        font-size: 0.78rem;
        font-weight: 600;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: all 0.15s;
        white-space: nowrap;
        flex-shrink: 0;
    }
    .tpl-btn-upload:hover {
        background: #4f46e5;
    }

    .alert-bar {
        padding: 12px 18px;
        border-radius: 10px;
        margin-bottom: 20px;
        font-weight: 600;
        font-size: 0.85rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .alert-bar-success {
        background: rgba(16,185,129,0.06);
        color: #059669;
        border: 1px solid rgba(16,185,129,0.15);
    }
    .alert-bar-error {
        background: rgba(239,68,68,0.06);
        color: #dc2626;
        border: 1px solid rgba(239,68,68,0.15);
    }
</style>

<div class="page-header">
    <h1 class="page-title">Template & Export</h1>
</div>

@if(session('success'))
    <div class="alert-bar alert-bar-success">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert-bar alert-bar-error">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        {{ session('error') }}
    </div>
@endif

<div class="tpl-grid">
    @foreach($categories as $category)
    <div class="tpl-card">
        <div>
            <div class="tpl-icon">
                @if(str_contains($category['id'], 'akreditasi'))
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 10 3 12 0v-5"/></svg>
                @else
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                @endif
            </div>
            <div class="tpl-title">{{ $category['name'] }}</div>
            <div class="tpl-desc">{{ $category['description'] }}</div>

            <div style="font-size: 0.65rem; font-weight: 600; color: #cbd5e1; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 6px;">Kolom</div>
            <div class="tpl-fields">
                @foreach($category['fields'] as $field)
                    <span class="tpl-field">{{ $field }}</span>
                @endforeach
            </div>
        </div>

        <div>
            <div class="tpl-actions">
                <a href="{{ route('admin.template.download', $category['id']) }}" class="tpl-btn tpl-btn-outline">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                    Template
                </a>
                <a href="{{ route('admin.template.export', $category['id']) }}" class="tpl-btn tpl-btn-green">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"/><polyline points="16 6 12 2 8 6"/><line x1="12" y1="2" x2="12" y2="15"/></svg>
                    Export
                </a>
            </div>

            <div class="tpl-import">
                <form action="{{ route('admin.template.import', $category['id']) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="tpl-import-label">Import Excel</div>
                    <div class="tpl-import-row">
                        <input type="file" name="file" accept=".xlsx,.xls,.csv" required>
                        <button type="submit" class="tpl-btn-upload">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                            Upload
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
