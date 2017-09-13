package com.example.faouzi.snakebitecrisis;

import android.content.Intent;
import android.graphics.Bitmap;
import android.net.Uri;
import android.provider.MediaStore;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Base64;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;

import org.json.JSONException;
import org.json.JSONObject;

import java.io.ByteArrayInputStream;
import java.io.ByteArrayOutputStream;
import java.io.IOException;
import java.net.URI;
import java.util.HashMap;
import java.util.Map;

public class MainActivity extends AppCompatActivity implements View.OnClickListener{

    private Button UploadBn,ChooseBn;
    private EditText Name;
    private EditText server;
    private ImageView imgView;
    private final int IMG_REQUEST = 1;
    private Bitmap bitmap;
    private String UploadUrl=" https://0320cfdd.ngrok.io" ;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        UploadBn=(Button) findViewById(R.id.uploadBn);
        ChooseBn=(Button) findViewById(R.id.chooseBn);
        Name= (EditText) findViewById(R.id.name);
        imgView=(ImageView) findViewById(R.id.imageView);
        server=(EditText) findViewById(R.id.server);
        server.setText(UploadUrl);
        UploadBn.setOnClickListener(this);
        ChooseBn.setOnClickListener(this);


    }


    @Override
    public void onClick(View view) {
        switch (view.getId())
        {
            case R.id.chooseBn:
                selectImage();
                break;
            case R.id.uploadBn:
                if (server.getText().toString()!="")
                    UploadUrl=server.getText().toString();
                uploadImage();
                break;
        }
    }

    public void selectImage(){
        Intent intent = new Intent();
        intent.setType("image/*");
        intent.setAction(intent.ACTION_GET_CONTENT);
        startActivityForResult(intent,IMG_REQUEST);
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        if (requestCode==IMG_REQUEST && resultCode==RESULT_OK && data!= null)
        {
            Uri path = data.getData();
            try {
                bitmap= MediaStore.Images.Media.getBitmap(getContentResolver(),path);
                imgView.setImageBitmap(bitmap);
                imgView.setVisibility(View.VISIBLE);
                Name.setVisibility(View.VISIBLE);
            } catch (IOException e) {
                e.printStackTrace();
            }
        }

    }

    private void uploadImage(){
        StringRequest stringRequest=new StringRequest(Request.Method.POST, UploadUrl,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        try {
                            JSONObject jsonObject=new JSONObject(response);
                            String Response = jsonObject.getString("response");
                            Toast.makeText(MainActivity.this,Response,Toast.LENGTH_LONG).show();
                            imgView.setImageResource(0);
                            imgView.setVisibility(View.GONE);
                            Name.setText("");
                            Name.setVisibility(View.GONE);
                        } catch (JSONException e) {
                            e.printStackTrace();
                        }
                    }
                }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {

            }
        })
        {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String,String> params= new HashMap<>();
                params.put("name",Name.getText().toString().trim());
                params.put("image",imageToString(bitmap));
                return params;
            }
        };
        MySingleton.getInstance(MainActivity.this).addToRequestQueue(stringRequest);
    }

    private String imageToString(Bitmap bitmap){
        ByteArrayOutputStream byteArrayOutputStream = new ByteArrayOutputStream();
        bitmap.compress(Bitmap.CompressFormat.JPEG,100,byteArrayOutputStream);
        byte[] imgBytes= byteArrayOutputStream.toByteArray();
        return Base64.encodeToString(imgBytes,Base64.DEFAULT);

    }
}
