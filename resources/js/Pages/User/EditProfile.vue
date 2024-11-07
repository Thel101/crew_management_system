<script setup>
</script>
<template>
    <div class="p-5 bg-white rounded-md border-slate-500 shadow-md m-5 max-w-5xl">
        <div class="flex flex-col gap-2 mt-2">
            <div class="flex flex-row">
                <div class="w-1/3 mr-2">
                    <label for="cert_name">Certificate Name</label>
                    <input id="cert_name" type="text" class="mt-1 block w-full" />
                    <span></span>
                </div>
                <div class="w-1/3 mr-2">
                    <label for="cert_no">Certificate Number</label>
                    <input id="cert_no" type="text" class="mt-1 block w-full" />
                    <span></span>
                </div>
            </div>
            <div class="flex flex-row">
                <div class="w-1/3 mr-2">
                    <label for="issue_date">Issue Date</label>
                    <input id="issue_date" type="date" class="mt-1 block w-full" />
                    <span></span>
                </div>
                <div class="w-1/3 mr-2">
                    <label for="expiry_date">Expiry Date</label>
                    <input id="expiry_date" type="date" class="mt-1 block w-full" />
                    <span></span>
                </div>
            </div>
            <div class="flex flex-row">
                <div class="w-1/3 mr-2">
                    <label for="issuing_authority">Issuing Authority</label>
                    <input id="issuing_authority" type="text" class="mt-1 block w-full" />
                    <span></span>
                </div>
                <div class="w-1/3 mr-2">
                    <label for="cert_image">Certificate Image</label>
                    <input id="cert_image" type="file" class="mt-1 block w-full" />
                    <span></span>
                </div>
            </div>
        </div>
    </div>
</template>
