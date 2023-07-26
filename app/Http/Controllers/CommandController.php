<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsStoreRequest;
use App\Models\Commands;
use App\Models\CommandsSides;
use App\Models\ProductsBubble;
use App\Models\ProductsMenu;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CommandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductsStoreRequest $request
     * @return JsonResponse|void
     */
    public function store(ProductsStoreRequest $request)
    {
        {

            try {
                $panier = $request->safe();
                $selectedIds = [
                    'thé' => array_map(fn($item) => $item['selectedTea'], $panier->all()),
                    'perle' => array_map(fn($item) => $item['selectedPerle'], $panier->all()),
                    'sirop' => array_map(fn($item) => $item['selectedSirop'], $panier->all()),
                ];

                $selectedIdsSide = [
                    'side' => array_map(function ($item) {
                        return $item['selectedSide'] ?? null;
                    }, $panier->all())
                ];
                $selectedIdsMenu = [
                    'menu' => array_map(fn($item) => $item['selectedMenu'], $panier->all()),
                ];

                $resMenu = array_map(fn($ids) => $this->verificationCommandMenu($ids, $panier), $selectedIdsMenu, array_keys($selectedIdsMenu));
                if (in_array(false, $resMenu, true)) {
                    return response()->json([
                        "message" => "vous n'avez pas l'autorisation"
                    ], 403);
                }

                $resSide = array_map(fn($ids, $type) => $this->verificationCommandSide($ids, $type), $selectedIdsSide, array_keys($selectedIdsSide));
                if (in_array(false, $resSide, true)) {
                    return response()->json([
                        "message" => "vous n'avez pas l'autorisation"
                    ], 403);
                }

                $res = array_map(fn($ids, $type) => $this->verificationCommand($ids, $type), $selectedIds, array_keys($selectedIds));
                if (in_array(false, $res, true)) {
                    return response()->json([
                        "message" => "vous n'avez pas l'autorisationS"
                    ], 403);
                }
                $user = \Auth::user();
                foreach ($panier as $key => $value) {
                    $command = Commands::create([
                        "users_id" => $user->id,
                        "perle_id" => $value['selectedPerle']['id'],
                        "sirop_id" => $value['selectedSirop']['id'],
                        "tea_id" => $value['selectedTea']['id'],
                        "menu_id" => $value['selectedMenu']['id'],
                        "status" => "attempt",
                    ]);
                    if ($selectedIdsSide['side'][$key] !== null) {
                        foreach ($selectedIdsSide['side'][$key] as $side) {
                            $commandSide = CommandsSides::create([
                                "command_id" => $command->id,
                                "side_id" => $side['id']
                            ]);
                        }
                    }
                }
                dd("oki");
            } catch (\Exception $e) {
                dd($e);
            }

        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('welcome');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function verificationCommand(array $selectedIds, string $type): bool
    {
        $verification = [];
        foreach ($selectedIds as $value) {
            if ($value !== null) {
                $res = ProductsBubble::where('id', $value['id'])->where('type', $type)->get();
                if ($res->isNotEmpty()) {
                    $verification[] = $res;
                }
            }
        }
        return count($verification) === count($selectedIds);
    }

    public function verificationCommandMenu(array $selectedIds, object $panier): bool
    {
        $verification = [];
        foreach ($selectedIds as $key => $value) {
            $res = ProductsMenu::select('sides')->where('id', $value['id'])->get();
            if ($res->isNotEmpty()) {
                $nbrSide = isset($panier[$key]['selectedSide']) ? count($panier[$key]['selectedSide']) : 0;
                if ($res[0]->sides === $nbrSide) {
                    $verification[] = $res;
                } else {
                    return false;
                }
            }
        }
        return count($verification) === count($selectedIds);
    }

    public function verificationCommandSide(array $selectedIds, string $type): bool
    {
        $mergedArray = array_merge(...array_filter($selectedIds));
        $verification = [];
        foreach ($mergedArray as $value) {
            $res = ProductsBubble::where('id', $value['id'])->where('type', $type)->get();
            if ($res->isNotEmpty()) {
                $verification[] = $res;
            }
        }
        return count($verification) == count($mergedArray);
    }
}
