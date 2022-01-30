<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use GuzzleHttp\Client as HttpClient;


class EmpleadoController extends Controller
{

   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $empleados = Empleado::orderBy('id','DESC') ->paginate(6);
        return view('empleado.index',compact('empleados'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $monedas = $this->obtenerMoneda();
        $estados = $this->obtenerEstados();
        //$resultados = json_decode($response ->getBody()->getContents());
        return view('empleado.create',compact('estados', 'monedas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        if ($this->validate($request,['nombre'=>'required', 'puesto'=>'required', 'edad'=>'required',
        ['estado'=>'required'],'antiguedad'=>'required', 'sueldo'=>'required', ['moneda'=>'required']])) {
            # code...
            Empleado::create($request->all());
        }
        return redirect('empleado')->with('status', 'Empleado agregado correctamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $empleados = Empleaado::find($id);
        return view('empleado.show',compact('empleados'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    
        $empleado = Empleado::find($id);
        $monedas = $this->obtenerMoneda();
        $estados = $this->obtenerEstados();

        return view('empleado.edit',compact('empleado', 'estados', 'monedas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        if ($this->validate($request,['nombre'=>'required', 'puesto'=>'required', 'edad'=>'required', 
        'antiguedad'=>'required', 'estado'=>'required', 'sueldo'=>'required', 'moneda'=>'required'])) {
            Empleado::find($id)->update($request->all());
        }
        
        return redirect()->route('empleado.index')->with('success','Registro actualizao correctamente');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        Empleado::destroy($id);

        return redirect()->route('empleado.index')->with('success','Eliminado correctamente');
    }



    public function obtenerEstados(){
        
        $client = new HttpClient(['base_uri' => 'https://beta-bitoo-back.azurewebsites.net/api/']);
            
        $response = $client->request('POST',"proveedor/obtener/lista_estados");

        $resultados = (((array)json_decode($response->getBody())->data)['lst_estado_proveedor']);

        return $resultados;
    }

    public function obtenerMoneda(){
       $url = "https://fx.currencysystem.com/webservices/CurrencyServer5.asmx?wsdl";
       $soapClient = new \SoapClient($url,['licenseKey' => ""]);

       $arrays = explode(";",$soapClient->AllCurrencies()->AllCurrenciesResult);
       
       return $arrays;
    }
}
