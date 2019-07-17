@extends('layouts.app')

@section('content')
<div id="app">
    <div class="container divis">
        <div class="row">
            <div class="col-lg-3 mt-4">
                <div class="form-group">
                    <label for="">Fecha de requerimento</label>
                    <input type="date" class="form-control" placeholder="" v-model="selectedDate">
                </div>
            </div>
            <div class="col-lg-3 mt-4">
                <div class="form-group">
                        <label for="">Hora a solicitar</label>
                        <div>
                            <el-time-select
                            v-model="selectedHour"
                            :picker-options="{
                                start: '08:00',
                                step: '00:15',
                                end: '18:00'
                            }"
                            placeholder="Seleccione la hora"
                            required>
                        </el-time-select>
                        </div>
                </div>
            </div>
            <div class="col-lg-3 mt-4">
                <div class="form-group">
                    <label for="">Ubicación</label>
                    <div>
                        <template>
                            <el-select v-model="selectedUbication" clearable placeholder="Seleccione ubicación">
                                <el-option
                                v-for="item in ubications"
                                :key="item.value"
                                :label="item.label"
                                :value="item.value"
                                required>
                                </el-option>
                            </el-select>
                        </template>
                    </div>
                    
                </div>
            </div>
            <div class="col-lg-3 mt-4">
                <div class="form-group">
                    <label for="">Solicitante</label>
                <input type="text" class="form-control"  v-model="applicant">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-4">
                <label for="">Observaciones</label>
                <input type="text" class="form-control" placeholder="..." v-model="observations" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-4">
                <button v-on:click="createSolicitud()" class="btn btn-block btn-primary">Añadir Solicitud</button>
            </div>
        </div>
        <div class="row mt-4">
                <template v-if="solicitudes.length > 0">
                        <el-table
                          :data="solicitudes"
                          border
                          style="width: 100%">
                          <el-table-column
                            prop="fecha"
                            label="Fecha"
                            width="180">
                          </el-table-column>
                          <el-table-column
                            prop="departamento"
                            label="Departamento"
                            width="120">
                          </el-table-column>
                          <el-table-column
                            prop="solicitante"
                            label="Solicitante"
                            width="120">
                          </el-table-column>
                          <el-table-column
                            prop="ubicacion"
                            label="Ubicación"
                            width="200">
                          </el-table-column>
                          <el-table-column
                            prop="hora"
                            label="Hora"
                            width="85">
                          </el-table-column>
                          <el-table-column
                            prop="observaciones"
                            label="Observaciones">
                          </el-table-column>
                          <el-table-column
                            
                            label=""
                            width="95">

                            <template slot-scope="scope" >
                                <el-button
                                size="mini"
                                type="danger"
                                @click="handleDelete(scope.$index, scope.row)"
                                >Eliminar</el-button>
                            </template>

                          </el-table-column>
                        </el-table>

                      </template>
        </div>
    </div>
</div>
@endsection
