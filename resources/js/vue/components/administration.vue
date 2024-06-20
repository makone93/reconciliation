<template>
    <div>
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="title">
                                <h4>Administration</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a @click="$router.push('/dashboard')">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Administration
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
                    <div class="title">
                        <h6 class="text-secondary">Vehicle Management</h6>
                    </div>
                    <button type="button" @click="$router.push('/new-vehicle')" class="btn btn-success mt-1">New vehicle</button> 
                    <button type="button" @click="$router.push('/vehicle-list')" class="btn btn-success mt-1">Vehicle List</button> 
                </div>
                <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
                    <div class="title">
                        <h6 class="text-secondary">Driver Management</h6>
                    </div>
                    <button type="button" @click="$router.push('/new-driver')" class="btn btn-success mt-1">New Driver</button> 
                    <button type="button" @click="$router.push('/driver-list')" class="btn btn-success mt-1">Driver List</button> 
                </div>
                <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
                    <div class="title">
                        <h6 class="text-secondary">Keys Management</h6>
                    </div>
                    <button type="button" @click="$router.push('/new-key')" class="btn btn-success mt-1">New Key</button> 
                    <button type="button" @click="$router.push('/keys-list')" class="btn btn-success mt-1">Keys List</button> 
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {

}
</script>